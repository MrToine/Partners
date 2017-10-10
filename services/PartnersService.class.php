<?php

/*##################################################
 *                        PartnersService.class.php
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

class PartnersService
{
	private static $db_querier;

	public static function __static(){

		self::$db_querier = PersistenceContext::get_querier();
	}

	public static function test($var, $bool = False){
		if($var != null){
			if($bool == True){
				echo '<pre class="warning">';
				var_dump($var);
				echo '</pre>';
				die();
			}else{
				echo '<pre class="warning">';
				var_dump($var);
				echo '</pre>';
			}
		}else{
			echo '<div.class="error">Variable vide.</div>';
		}
	}

	//-> CONFIG

	public static function get_config(){

		$row = self::$db_querier->select_single_row_query('SELECT * FROM '.PartnersSetup::$partners_config_table);

		$config = new PartnerConfig();
		$config->set_properties($row);
		return $config;
	}

	//->News
	public static function get_news($arg = ""){
		if($arg){
			try {
				$find = self::$db_querier->get_column_value(PREFIX.'partners_news', 'COUNT(*)', 'WHERE partner_id = :partner_id', array('partner_id' => $arg));
			} catch (RowNotFoundException $e) {}
				
				if($find <= 0){
					$result = $find;
				}else{
					$result = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'partners_news WHERE partner_id=:partner_id', array('partner_id' => $arg));
				}
			}

		return $result;
	}

	public static function get_partner($condition = "", $arg = "")
	{
		if($condition){
			$row = self::$db_querier->select_single_row_query('SELECT * FROM '.PartnersSetup::$partners_table.' '.$condition, $arg);
			$partner = new Partner();
			$partner->set_properties($row);
			return $partner;
		}else{
			$row = self::$db_querier->select_single_row_query('SELECT * FROM '.PartnersSetup::$partners_table);
			
			$partner = new Partner();
			$partner->set_properties($row);
			return $partner;
		}
	}

	public static function add(Partner $partner)
	{
		$result = self::$db_querier->insert(PartnersSetup::$partners_table, $partner->get_properties());
		return $result->get_last_inserted_id();
	}

	public static function update(Partner $partner)
	{
		self::$db_querier->update(PartnersSetup::$partners_table, $partners->get_properties(), 'WHERE id=:id', array('id', $partners->get_id()));
	}

	public static function delete($condition, array $parameters)
	{
		self::$db_querier->delete(PartnersSetup::$partners_table, $condition, $parameters);
	}

	public static function user_is_partner($arg){
		try {
			$find = self::$db_querier->get_column_value(PartnersSetup::$partners_table, 'COUNT(*)', 'WHERE user_id = :user_id', array('user_id' => $arg));
		} catch (RowNotFoundException $e) {}
			
		return $find;
	}

	public static function partner_exist($arg){
		
		if($type == "mail"){
			try {
				$find = self::$db_querier->get_column_value(PartnersSetup::$partners_table, 'COUNT(*)', 'WHERE mail = :mail', array('mail' => $arg));
			} catch (RowNotFoundException $e) {}
		}elseif($type == "user_id"){
			try {
				$find = self::$db_querier->get_column_value(PartnersSetup::$partners_table, 'COUNT(*)', 'WHERE user_id = :user_id', array('user_id' => $arg));
			} catch (RowNotFoundException $e) {}
		}
			
			
		return $find;
	}

	public static function update_config($args)
	{
		self::$db_querier->update(PartnersSetup::$partners_config_table, $args, '');
	}

	public static function protect_session($value){
		$value = sha1($value);
		return sha1($value);
	}
}