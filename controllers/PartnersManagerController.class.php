<?php
/*##################################################
 *                            PartnersManagerController.class.php
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

class PartnersManagerController extends ModuleController {
	
	private $view,
			$lang,
			$action,
			$partner,
			$user,
			$config;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->action = AppContext::get_request()->get_getstring('action');
		$this->init();

		$this->user = AppContext::get_current_user();
		if($this->user->check_level(User::MEMBER_LEVEL)){
			$this->view->put('USER_CONNECTED', True);
		}else{
			$this->view->put('USER_CONNECTED', False);
		}

		if(PartnersService::partner_exist('user_id', $this->user->get_id())){
			$this->config = PartnersService::get_config();

			if($this->config->get_partner_manager() == "Oui"){
				if($this->action == "home"){	
					$this->get_home();
				}elseif($this->action == "edit"){
					$this->get_edit();
				}elseif($this->action == "news"){
					$this->get_news();
				}else{
					$this->get_home();
				}
			}else{
				AppContext::get_response()->redirect(PartnersUrlBuilder::home());
			}
		}else{
			AppContext::get_response()->redirect(PartnersUrlBuilder::home());
		}

			
		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersManagerController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_form($page){
		
		if($page == "edit") {
			$form = new HTMLForm('PartnersForm');

			// FIELDSET
			$fieldset = new FormFieldsetHTML('fieldset', 'Editer Partenaire');
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
		}
			

		return $form;
	}

	private function get_home(){

		$this->view->put('HOME', True);

		if($this->config->get_news_manager() == "Oui"){
			$response_news = True;
		}else{
			$response_news = False;
		}

		if(PartnersService::user_is_partner($this->user->get_id())){
			$this->view->put_all(array(
				'USER_IS_PARTNER' => True,
				'NEWS_MANAGER_ACTIVE' => $response_news
		));
		}else{
			$this->view->put('USER_IS_PARTNER', False);
		}
			
	}

	private function get_edit(){

		if(PartnersService::user_is_partner($this->user->get_id())){
			$this->view->put('USER_IS_PARTNER', True);

			$form = $this->build_form('edit');
			
			if ($this->submit_button->has_been_submited())
			{
				if ($form->validate())
				{
					
					$result = PersistenceContext::get_querier()->update(PREFIX.'partners', array(
						'name' => $form->get_value('name'), 
						'link' => $form->get_value('link'), 
						'link_banner' => $form->get_value('link_banner'), 
						'description' => $form->get_value('description'),
					), 'WHERE user_id=:user_id', array('user_id' => $this->user->get_id()));

					$this->view->put('EDIT_OK', True);
				}
			}
		}else{
			$this->view->put('USER_IS_PARTNER', False);
		}

			

		$this->view->put_all(array(
					'EDIT' => True,
					'edit_form' => $form->display()
				));
	}

	public function get_news(){
		if($this->config->get_news_manager() == "Oui"){
			if(PartnersService::user_is_partner($this->user->get_id())){
				$this->view->put('USER_IS_PARTNER', True);

				$result = PartnersService::get_news($this->user->get_id());

				if($result){
					while ($row = $result->fetch())
					{
						$news = new PartnerNews();
						$news->set_properties($row);

						$this->view->assign_block_vars('news', $news->get_array_tpl_vars());
						$this->view->put_all(array(
							'DELETE_LINK' => PartnersUrlBuilder::delete_news($this->user->get_id(), $news->get_id())->absolute(),
							'EDIT_LINK' => "",
						));

					}

					$result->dispose();
				}

				$this->view->put_all(array(
							'NEWS' => True,
						));
			}else{
				$this->view->put('USER_IS_PARTNER', False);
			}
		}else{
			AppContext::get_response()->redirect(PartnersUrlBuilder::home());
		}
	}

	public function get_partner(){
		return PartnersService::get_partner('WHERE user_id = :user_id', array('user_id' => $this->user->get_id()));
	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], PartnersUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['manager_page'], PartnersUrlBuilder::partner_manager('home')->rel());
		$breadcrumb->add($this->action, PartnersUrlBuilder::partner_manager($this->action)->rel());
		
		return $response;
	}
}