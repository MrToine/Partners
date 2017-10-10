<?php
/*##################################################
 *                            PartnersController.class.php
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

class PartnersController extends ModuleController {
	
	private $view;
	private $lang;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->init();
		
		$config = PartnersService::get_config();

		if($config->get_display_rank() == "Oui"){
			$ordered_choice = 'entries';
			$order_choice_tpl = True;
		}elseif($config->get_display_rank() == "Non"){
			$ordered_choice = 'id';
			$order_choice_tpl = False;
		}else{
			$ordered_choice = 'erreur';
			$order_choice_tpl = Null;
		}


		$result = PersistenceContext::get_querier()->select_rows(
			PREFIX.'partners', array(
				'*'
			), 
			'ORDER BY '.$ordered_choice.' DESC'
		);

		while ($row = $result->fetch())
		{
			$partner = new Partner();
			$partner->set_properties($row);
			
			$this->view->put('ORDER_CHOICE', $order_choice_tpl);
			$this->view->assign_block_vars('partner', $partner->get_array_tpl_vars());
		}
		
		$result->dispose();

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);
		
		return $response;
	}
}