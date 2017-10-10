<?php
/*##################################################
 *                            PartnersAddController.class.php
 *                            -------------------
 *   begin                : October 24, 2014
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

class PartnersAddController extends ModuleController {
	
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
					if($this->user->check_level(User::MEMBER_LEVEL)){
						$user_id = $this->user->get_id();
					}else{
						$user_id = 0;
					}
					$result = PersistenceContext::get_querier()->insert(PREFIX.'partners', array(
						'user_id' => $user_id,
						'name' => $form->get_value('name'), 
						'mail' => $form->get_value('email'),
						'password' => "null",
						'link' => $form->get_value('link'), 
						'link_banner' => $form->get_value('link_banner'), 
						'description' => $form->get_value('description'),
						'ip_adress' => $_SERVER['REMOTE_ADDR']
					));

					$this->view->put_all(array(
						'C_RESULT' => true,
						'C_EDIT' => false,
						'PARTNER' => $result,
						'CODE_LINK' => '<div class="notice">'.htmlspecialchars('<a href="'.$this->lang['link_entry'].$result->get_last_inserted_id().'"><img src="'.$this->lang['link_my_banner'].'" /></a>').'</div>'   
					));
				}		
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
		$fieldset->add_field(new FormFieldTextEditor('name', $this->lang['form_name'], '', array(
			'maxlength' => 25, 'description' => $this->lang['form_name_desc'], 'required' => true)
		));
		$fieldset->add_field(new FormFieldTextEditor('email', $this->lang['form_mail'], '', array(
			'maxlength' => 155, 'description' => $this->lang['form_mail_desc'], 'required' => true)
		));
		$fieldset->add_field(new FormFieldTextEditor('link', $this->lang['form_link'], '', array(
			'maxlength' => 255, 'description' => $this->lang['form_link_desc'], 'required' => true),
			array(new FormFieldConstraintUrl())
		));
		$fieldset->add_field(new FormFieldTextEditor('link_banner', $this->lang['form_link_banner'], '', array(
			'maxlength' => 255, 'description' => $this->lang['form_link_banner_desc'], 'required' => true),
			array(new FormFieldConstraintUrl())
		));

		// DESCRIPTION
		$fieldset->add_field(new FormFieldRichTextEditor('description', $this->lang['form_description'], ''));

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