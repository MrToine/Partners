<?php
/*##################################################
 *                      AdminPartnersManageController.class.php
 *                            -------------------
 *   begin                : October 31, 2014
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

class AdminPartnersManageController extends AdminModuleController
{
	const NUMBER_ITEMS_PER_PAGE = 20;
	
	private $lang;
	private $view;
	
	public function execute(HTTPRequestCustom $request)
	{
		$this->init();
		
		$this->build_view($request);
		
		return new AdminPartnersDisplayResponse($this->view, $this->lang['partners_management']);
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = new FileTemplate('partners/AdminPartnersManageController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function build_view(HTTPRequestCustom $request)
	{
		$this->init();
		
		$result = PersistenceContext::get_querier()->select_rows(
			PREFIX.'partners', array(
				'*'
			), 
			'ORDER BY id'
		);

		while ($row = $result->fetch())
		{
			$partner = new Partner();
			$partner->set_properties($row);
			
			$this->view->assign_block_vars('partner', $partner->get_array_tpl_vars());
		}
		
		$result->dispose();

	}
}
?>