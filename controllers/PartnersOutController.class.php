<?php
/*##################################################
 *                            PartnersOutController.class.php
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

class PartnersOutController extends ModuleController {

	private $partner;
	private $lang;
	private $view;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->init();

		$partner_id = $request->get_getint('partner_id');

		if(PersistenceContext::get_querier()->count(PREFIX.'partners', 'WHERE id=:id', array('id' => $partner_id)) != 0){

			$partner_link = PersistenceContext::get_querier()->select_single_row(PREFIX.'partners', array('link'), 'WHERE id=:id', array('id' => $partner_id));

			$return = $this->redirect($partner_id, $partner_link);

		}else{

			$return =  $this->lang['partner_not_exists'];

		}
		
		$this->view->put_all(array(
					'RETOUR' => $return
			));

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/PartnersEntryController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function redirect($partner_id, $partner_link){

		$partner_out = PersistenceContext::get_querier()->select_single_row(PREFIX.'partners', array('outputs', 'ip_adress'), 'WHERE id=:id', array('id' => $partner_id));

		if($partner_out['ip_adress'] != $_SERVER['REMOTE_ADDR']){

			$partner_out['outputs']++;

			PersistenceContext::get_querier()->update(PREFIX.'partners', array(
				'outputs' => $partner_out['outputs']++
			), 'WHERE id=:id', array('id' => $partner_id));

		}

		$redirect = AppContext::get_response()->redirect($partner_link['link']);

	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);
		
		return $response;
	}

}