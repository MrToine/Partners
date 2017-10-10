<?php
/*##################################################
 *                            PartnersCreateNewsController.class.php
 *                            -------------------
 *   begin                : October 10, 2017
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

class PartnersCreateNewsController extends ModuleController {

	private $view;
	private $lang;
	private $submit_button;
	private $user;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->init();

		$this->user = AppContext::get_current_user();
		if(PartnersService::user_is_partner($this->user->get_id())){
			$this->view->put('USER_IS_PARTNER', True);
		}

		$form = $this->build_form();
		
		if ($this->submit_button->has_been_submited()){
			if ($form->validate()){
				if(PartnersService::partner_exist($form->get_value('email'))){
					$this->view->put('PARTNER_EXIST', True);
				}else{
					$result = PersistenceContext::get_querier()->insert(PREFIX.'partners_news', array(
						'partner_id' => $this->user->get_id(),
						'title' => $form->get_value('title'), 
						'content' => $form->get_value('content'),
						'created' => time()
					));

					$this->view->put('ADD_NEWS_OK', True);
				}		
			}
		}

		$this->view->put('form', $form->display());
		
		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersCreateNewsController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_form()
	{
		$form = new HTMLForm('PartnersForm');

		// FIELDSET
		$fieldset = new FormFieldsetHTML('fieldset', 'Créer une news Partenaire');
		$form->add_fieldset($fieldset);
		
		// INFOS
		$fieldset->add_field(new FormFieldTextEditor('title', $this->lang['manager.title_form_news'], '', array(
			'maxlength' => 25, 'description' => $this->lang['manager.title_form_news_desc'], 'required' => true)
		));

		// DESCRIPTION
		$fieldset->add_field(new FormFieldRichTextEditor('description', $this->lang['manager.content_form_news'], '', array('required' => true)));

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form->add_fieldset($buttons_fieldset);
		
		return $form;
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