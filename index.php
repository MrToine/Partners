<?php
/*##################################################
 *                                 index.php
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
define('PATH_TO_ROOT', '..');
 
require_once PATH_TO_ROOT . '/kernel/init.php';
 
$url_controller_mappers = array(
	//Admin
	new UrlControllerMapper('AdminPartnersConfigController', '`^/admin/config`'),
	new UrlControllerMapper('AdminPartnersManageController', '`^/admin/manage`'),
	new UrlControllerMapper('AdminPartnersUpdateBannerController', '`^/admin/update/banner`'),
	new UrlControllerMapper('AdminPartnersDeleteController', '`^/delete(?:/([0-9]+))?/?$`', array('partner_id')),
	new UrlControllerMapper('AdminPartnersEditController', '`^/edit(?:/([0-9]+))?/?$`', array('partner_id')),

	//Display
	new UrlControllerMapper('PartnersAddController', '`^/add`'),
	new UrlControllerMapper('PartnersManagerController', '`^/manager(?:/([a-z]+))?/?$`', array('action')),
	new UrlControllerMapper('PartnersDeleteNewsController', '`^/manager(?:/([0-9]+))?/news(?:/([0-9]+))?/delete`', array('partner_id', 'news_id')),
	new UrlControllerMapper('PartnersCreateNewsController', '`^/manager/news/create`'),
	new UrlControllerMapper('PartnersNewsController', '`/news(?:/([0-9]+))?/?$`', array('news_id')),
	new UrlControllerMapper('PartnersEntryController', '`/entry(?:/([0-9]+))?/?$`', array('partner_id')),
	new UrlControllerMapper('PartnersOutController', '`/out(?:/([0-9]+))?/?$`', array('partner_id')),
	//new UrlControllerMapper('PartnersController', '`^.*$`'),
);
 
DispatchManager::dispatch($url_controller_mappers);