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

class AdminPartnersUpdateBannerController extends AdminModuleController {
	
	private $view;
	private $lang;
	private $submit_button;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->init();
		
		$this->generate_response();

		return new AdminPartnersDisplayResponse($this->view, $this->lang['partners_update_banner']);
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersUpdateBannerController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_form()
	{
		$form = new HTMLForm('PartnersForm');

		// FIELDSET
		$fieldset = new FormFieldsetHTML('fieldset', 'Image partenaire');
		$form->add_fieldset($fieldset);
		
		// FILE PICKER
		$fieldset->add_field(new FormFieldFilePicker('file', 'Logo'));

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form->add_fieldset($buttons_fieldset);
		
		return $form;
	}

	private function generate_response()
	{

		$form = $this->build_form();

		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);
		
		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], PartnersUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['add_page'], PartnersUrlBuilder::add()->rel());

		if ($this->submit_button->has_been_submited())
		{
			if ($form->validate())
			{

				$file = $form->get_value('file');

				if($file !== null)
				{

					$file->save(new File(PATH_TO_ROOT.'/partners/banner.png'));

					$this->view->put_all(array(
						'C_RESULT' => true,
						'TYPE' => 'success',
						'UPDATE_BANNER_MESSAGE' => $this->lang['update_banner_success'],
					));
				}else{

					$this->view->put_all(array(
						'C_RESULT' => true,
						'TYPE' => 'error',
						'UPDATE_BANNER_MESSAGE' => $this->lang['update_banner_error'],
					));

				}
	
			}
		}

		$this->view->put_all(array(
					'MY_BANNER' => $this->lang['my_banner']
					));

		$this->view->put('form', $form->display());

		return $response;
	}
}