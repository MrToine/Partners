<?php
/*##################################################
 *                            PartnersAddController.class.php
 *                            -------------------
 *   begin                : November 02, 2014
 *   copyright            : (C) 2014 Anthony VIOLET
 *   email                : anthony.violet@outlook.fr
 *
 *  
 ###################################################
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 ###################################################*/

class AdminPartnersEditController extends AdminModuleController {
	
	private $view,
			$lang,
			$partner,
			$submit_button,
			$partner_id;
	
	public function execute(HTTPRequestCustom $request)
	{

		$this->partner_id = AppContext::get_request()->get_getint('partner_id');

		$this->get_partner();

		$this->init();

		$form = $this->build_form();
		
		if ($this->submit_button->has_been_submited())
		{
			if ($form->validate())
			{
				
				$result = PersistenceContext::get_querier()->update(PREFIX.'partners', array(
					'name' => $form->get_value('name'), 
					'link' => $form->get_value('link'), 
					'link_banner' => $form->get_value('link_banner'), 
					'description' => $form->get_value('description'),
				), 'WHERE id=:id', array('id' => $partner_id));
				
				$this->view->put_all(array(
					'C_RESULT' => true,
					'C_EDIT' => true
				));
			}
		}

		$this->view->put('form', $form->display());
		
		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersFormController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_form()
	{

		$form = new HTMLForm('PartnersForm');

		// FIELDSET
		$fieldset = new FormFieldsetHTML('fieldset', 'Devenir Partenaire');
		$form->add_fieldset($fieldset);
		
		// INFOS
		$fieldset->add_field(new FormFieldTextEditor('name', $this->lang['form_name'], $this->get_partner()->get_name(), array(
			'maxlength' => 25, 'description' => $this->lang['form_name_desc'], 'required' => true)
		));
		$fieldset->add_field(new FormFieldTextEditor('link', $this->lang['form_link'], $this->get_partner()->get_link(), array(
			'maxlength' => 255, 'description' => $this->lang['form_link_desc'], 'required' => true),
			array(new FormFieldConstraintUrl())
		));
		$fieldset->add_field(new FormFieldTextEditor('link_banner', $this->lang['form_link_banner'], $this->get_partner()->get_link_banner(), array(
			'maxlength' => 255, 'description' => $this->lang['form_link_banner_desc'], 'required' => true),
			array(new FormFieldConstraintUrl())
		));

		// DESCRIPTION
		$fieldset->add_field(new FormFieldRichTextEditor('description', $this->lang['form_description'], $this->get_partner()->get_description()));

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form->add_fieldset($buttons_fieldset);
		
		return $form;
	}

	private function get_partner()
	{

		$row = $this->partner = PersistenceContext::get_querier()->select_single_row_query('SELECT * FROM '.PartnersSetup::$partners_table.' WHERE id=:id', array('id' => $this->partner_id));

		$this->partner = new Partner();
		$this->partner->set_properties($row);

		return $this->partner;
	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);
		
		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], PartnersUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['add_page'], PartnersUrlBuilder::add()->rel());

		return $response;
	}
}