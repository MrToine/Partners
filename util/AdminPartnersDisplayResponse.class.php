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

class AdminPartnersDisplayResponse extends AdminMenuDisplayResponse
{
	public function __construct($view, $title_page)
	{
		parent::__construct($view);
		
		$lang = LangLoader::get('common', 'partners');
		$this->set_title($lang['module_title']);

		$this->add_link($lang['partners_configuration'], PartnersUrlBuilder::config_partners());
		$this->add_link($lang['partners_management'], PartnersUrlBuilder::manage_partners());
		$this->add_link($lang['partners_add'], PartnersUrlBuilder::add());
		$this->add_link($lang['partners_update_banner'], PartnersUrlBuilder::update_banner());
		
		$env = $this->get_graphical_environment();
		$env->set_page_title($title_page);
	}
}
?>