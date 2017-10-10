<?php
/*##################################################
 *                    PartnersExtensionPointProvider.class.php
 *                            -------------------
 *   begin                : October 26, 2014
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

class PartnersSetup extends DefaultModuleSetup
{

	public static $partners_table;
	public static $partners_config_table;

	private $partner;

	public static function __static(){

		self::$partners_table = PREFIX . 'partners';
		self::$partners_config_table = PREFIX . 'partners_config';
		self::$partners_news_table = PREFIX . 'partners_news';

	}

	public function install(){

		$this->drop_tables();
		$this->create_tables();
		$this->insert_data();
 
	}
 
	public function uninstall(){
 
		$this->drop_tables();

	}

	public function drop_tables(){

		PersistenceContext::get_dbms_utils()->drop(self::$partners_table);
		PersistenceContext::get_dbms_utils()->drop(self::$partners_config_table);
		PersistenceContext::get_dbms_utils()->drop(self::$partners_news_table);

	}

	public function create_tables(){

		$partners_fields = array(
			'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
			'name' => array('type' => 'string', 'length' => 250, 'notnull' => 1),
			'mail' => array('type' => 'string', 'lenght' => 250, 'notnull' => 1),
			'description' => array('type' => 'text', 'length' => 65000),
			'link' => array('type' => 'string', 'length' => 250, 'notnull' => 1),
			'link_banner' => array('type' => 'string', 'length' => 250, 'notnull' => 1),
			'entries' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1, 'default' => "'0'"),
			'outputs' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1, 'default' => "'0'"),
			'ip_adress' => array('type' => 'string', 'lenght' => 10, 'notnull' => 1),
		);
		$partners_options = array(
			'primary' => array('id'),
			'indexes' => array(
				'name' => array('type' => 'fulltext', 'fields' => 'name'),
				'mail' => array('type' => 'fulltext', 'fields' => 'mail'),
				'description' => array('type' => 'fulltext', 'fields' => 'description'),
				'link' => array('type' => 'fulltext', 'fields' => 'link'),
				'link_banner' => array('type' => 'fulltext', 'fields' => 'link_banner'),
			),
		);

		$news_fields = array(
			'id' => array('type' => 'integer', 'lenght' => 11, 'autoincrement' => true, 'notnull' => 1),
			'user_id' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1, 'default' => "'0'"),
			'title' => array('type' => 'string', 'lenght' => 255, 'notnull' => 1),
			'content' => array('type' => 'string', 'lenght' => 65000),
			'created' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'edited' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1)
		);

		$news_options = array(
			'primary' => array('id'),
			'indexes' => array(
				'title' => array('type' => 'fulltext', 'fields' => 'title'),
				'content' => array('type' => 'fulltext', 'fields' => 'content')
			)
		);

		$config_fields = array(
			'nb_partners_mini_module' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 5),
			'display_rank' => array('type' => 'string', 'length' => 3, 'notnull' => 1, 'default' => 'Oui'),
			'partner_manager' => array('type' => 'string', 'length' => 3, 'notnull' => 1, 'default' => 'Oui'),
			'news_manager' => array('type' => 'string', 'length' => 3, 'notnull' => 1, 'default' => 'Oui'),
		);

		$config_options = array(
			'indexes' => array(
				'display_rank' => array('type' => 'fulltext', 'fields' => 'display_rank'),
				'partner_manager' => array('type' => 'fulltext', 'fields' => 'partner_manager'),
				'news_manager' => array('type' => 'fulltext', 'fields' => 'news_manager'),
			),
		);
		PersistenceContext::get_dbms_utils()->create_table(self::$partners_table, $partners_fields, $partners_options);
		PersistenceContext::get_dbms_utils()->create_table(self::$partners_config_table, $config_fields, $config_options);
		PersistenceContext::get_dbms_utils()->create_table(self::$partners_news_table, $news_fields, $news_options);

	}

	private function insert_data(){

        $this->partner = LangLoader::get('install', 'partners');
		$this->insert_partners_data();
	}

	public function insert_partners_data(){

		PersistenceContext::get_querier()->insert(self::$partners_table, array(
			'id' => 1,
			'mail' => $this->partner['partner.mail'],
			'name' => $this->partner['partner.name'],
			'description' => $this->partner['partner.description'],
			'link' => $this->partner['partner.link'],
			'link_banner' => $this->partner['partner.link_banner'],
			'ip_adress' => 'NULL'
		));

		PersistenceContext::get_querier()->insert(self::$partners_config_table, array(
			'nb_partners_mini_module' => 5,
			'display_rank' => "Oui",
			'partner_manager' => "Oui",
			'news_manager' => "Oui"
		));

	}
}