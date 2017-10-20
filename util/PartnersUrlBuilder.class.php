<?php
/*##################################################
 *                            PartnersUrlBuilder.class.php
 *                            -------------------
 *   begin                : October 27, 2014
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

class PartnersUrlBuilder
{

	const DEFAULT_SORT_FIELD = '';
	const DEFAULT_SORT_MODE = 'desc';
	private static $dispatcher = '/partners';
	
	/**
	 * @return Url
	 */
	public static function home()
	{
		return DispatchManager::get_url(self::$dispatcher, '/');
	}

	public static function config_partners()
	{
		return DispatchManager::get_url(self::$dispatcher, '/admin/config');
	}

	public static function manage_partners()
	{
		return DispatchManager::get_url(self::$dispatcher, '/admin/manage');
	}

	public static function partner_manager($page)
	{
		return DispatchManager::get_url(self::$dispatcher, '/manager/'.$page);
	}

	public static function delete_news($partner_id, $news_id)
	{
		return DispatchManager::get_url(self::$dispatcher, '/manager/'.$partner_id.'/news/'.$news_id.'/delete');
	}

	public static function create_news()
	{
		return DispatchManager::get_url(self::$dispatcher, '/manager/news/create');
	}

	public static function add()
	{
		return DispatchManager::get_url(self::$dispatcher, '/add');
	}

	public static function edit()
	{
		return DispatchManager::get_url(self::$dispatcher, '/edit');
	}

	public static function delete()
	{
		return DispatchManager::get_url(self::$dispatcher, '/delete');
	}

	public static function update_banner()
	{
		return DispatchManager::get_url(self::$dispatcher, '/admin/update/banner');
	}

	public static function link_entry()
	{
		return DispatchManager::get_url(self::$dispatcher, '/entry/');
	}

	public static function link_out()
	{
		return DispatchManager::get_url(self::$dispatcher, '/out/');
	}

	public static function news()
	{
		return DispatchManager::get_url(self::$dispatcher, '/news/');
	}

	public static function link_my_banner()
	{
		return DispatchManager::get_url(self::$dispatcher, '/banner.png');
	}
}