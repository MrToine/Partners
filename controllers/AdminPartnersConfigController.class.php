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

class AdminPartnersConfigController extends AdminModuleController {
	
	private $view,
			$lang,
			$partner,
			$submit_button;
	
	public function execute(HTTPRequestCustom $request)
	{

		$this->init();

		$form_general = $this->build_form();
		
		if ($this->submit_button->has_been_submited())
		{
			if ($form_general->validate())
			{
				PartnersService::update_config(array(
					'nb_partners_mini_module' => $form_general->get_value('select_nb_partners_mini_module')->get_label(), 
					'display_rank' => $form_general->get_value('radio_rank')->get_label(), 
					'partner_manager' => $form_general->get_value('radio_manager')->get_label(),
					'news_manager' => $form_general->get_value('radio_news_manager')->get_label(),
				));
				$this->view->put_all(array(
					'FORM_OK' => true,
				));
			}
		}

		$this->view->put('form_general', $form_general->display());
		
		return new AdminPartnersDisplayResponse($this->view, $this->lang['partners_configuration']);
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/AdminPartnersConfigController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_form()
	{
		$form_general = new HTMLForm('PartnersForm');

		// FIELDSET
		$fieldset = new FormFieldsetHTML('fieldset', "Configuration du Module");
		$form_general->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldSimpleSelectChoice('select_nb_partners_mini_module', $this->lang['config.nb_partners_mini_module'], '',
			array(
				new FormFieldSelectChoiceOption($this->get_config()->get_nb_partners_mini_module(), $this->get_config()->get_nb_partners_mini_module()),
				new FormFieldSelectChoiceOption('----', '----'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['1'], '1'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['2'], '2'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['3'], '3'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['4'], '4'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['5'], '5'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['6'], '6'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['7'], '7'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['8'], '8'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['9'], '9'),
				new FormFieldSelectChoiceOption($this->lang['config.select_nb_partners_mini_module']['10'], '10')
				)),
			array('required' => true)
		);

		$fieldset->add_field(new FormFieldSimpleSelectChoice('radio_rank', $this->lang['config.display_rank'], '',
			array(
				new FormFieldSelectChoiceOption($this->get_config()->get_display_rank(), $this->get_config()->get_display_rank()),
				new FormFieldSelectChoiceOption('----', '----'),
				new FormFieldSelectChoiceOption($this->lang['config.display_rank.yes'], '1'),
				new FormFieldSelectChoiceOption($this->lang['config.display_rank.no'], '0'),
				)),
			array('required' => true)
		);

		$fieldset->add_field(new FormFieldSimpleSelectChoice('radio_manager', $this->lang['config.partner_manager'], '',
			array(
				new FormFieldSelectChoiceOption($this->get_config()->get_partner_manager(), $this->get_config()->get_partner_manager()),
				new FormFieldSelectChoiceOption('----', '----'),
				new FormFieldSelectChoiceOption($this->lang['config.partner_manager.yes'], '1'),
				new FormFieldSelectChoiceOption($this->lang['config.partner_manager.no'], '0'),
				)),
			array('required' => true)
		);

		$fieldset->add_field(new FormFieldSimpleSelectChoice('radio_news_manager', $this->lang['config.news_manager'], '',
			array(
				new FormFieldSelectChoiceOption($this->get_config()->get_news_manager(), $this->get_config()->get_news_manager()),
				new FormFieldSelectChoiceOption('----', '----'),
				new FormFieldSelectChoiceOption($this->lang['config.news_manager.yes'], '1'),
				new FormFieldSelectChoiceOption($this->lang['config.news_manager.no'], '0'),
				)),
			array('required' => true)
		);


		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form_general->add_fieldset($buttons_fieldset);
		
		return $form_general;
	}

	private function get_config()
	{
		$this->config = PartnersService::get_config();

		return $this->config;
	}
}