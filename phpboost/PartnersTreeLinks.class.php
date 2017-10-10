<?php
/*##################################################
 *		                         PartnersTreeLinks.class.php
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

class PartnersTreeLinks implements ModuleTreeLinksExtensionPoint
{
	public function get_actions_tree_links()
	{
		$lang = LangLoader::get('common', 'partners');
		$tree = new ModuleTreeLinks();
		
		$tree->add_link(new AdminModuleLink($lang['partners_configuration'], PartnersUrlBuilder::config_partners()));
		$tree->add_link(new AdminModuleLink($lang['partners_management'], PartnersUrlBuilder::manage_partners()));
		$tree->add_link(new AdminModuleLink($lang['partners_add'], PartnersUrlBuilder::add()));
		$tree->add_link(new AdminModuleLink($lang['partners_update_banner'], PartnersUrlBuilder::update_banner()));

		return $tree;
	}
}
?>