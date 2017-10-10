<?php
/*##################################################
 *                                 BlogPostController.class.php
 *                            -------------------
 *   begin                : November 07, 2014
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
private $lang,
		$view;

class PartnersNewsController extends ModuleController {
	
	public function execute(HTTPRequestCustom $request){

	 $this->init();

	 return $this->generate_response();

	}	

	private function init(){
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = New FileTemplate('partners/')
	}

	private function generate_response(){

	}
}

	