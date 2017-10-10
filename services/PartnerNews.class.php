<?php
/*##################################################
 *                            Partner.class.php
 *                            -------------------
 *   begin                : October 31, 2014
 *   copyright            : (C) 2014 Anthony VIOLET
 *   econtent                : anthony.violet@outlook.fr
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

class PartnerNews {

	private $_id,
			$_partner_id,
			$_title,
			$_content,
			$_created,
			$_edited;

	public function get_id(){

		return $this->_id;

	}

	public function get_partner_id(){

		return $this->_partner_id;

	}

	public function get_title(){

		return $this->_title;
		
	}

	public function get_content(){

		return $this->_content;

	}

	public function get_created(){

		return $this->_created;

	}

	public function get_description(){

		return $this->_description;
		
	}

	public function set_id($id){

		$id = (int) $id;

		if($id > 0){

			$this->_id = $id;

		}
	}

	public function set_partner_id($partner_id){

		$partner_id = (int) $partner_id;

		if($partner_id > 0){

			$this->_partner_id = $partner_id;

		}
	}

	public function set_title($title){

		if(is_string($title)){

			$this->_title = htmlspecialchars($title);

		}

	}

	public function set_content($content) {

		if(is_string($content)){

			$this->_content = htmlspecialchars($content);

		}

	}

	public function set_created($created) {

		if(is_string($created)){

			$this->_created = htmlspecialchars($created);

		}

	}

	public function set_edited($edited){

		$edited = (int) $edited;

		if(is_int($edited)){

			$this->_edited = htmlspecialchars($edited);

		}

	}

	public function get_properties()
	{
		return array(
			'id' => $this->get_id(),
			'partner_id' => $this->get_partner_id(),
			'title' => TextHelper::htmlspecialchars($this->get_title()),
			'content' => TextHelper::htmlspecialchars($this->get_content()),
			'created' => TextHelper::htmlspecialchars($this->get_created()),
			'edited' => (int) $this->get_edited()
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_id = $properties['id'];
		$this->_partner_id = $properties['partner_id'];
		$this->_title = $properties['title'];
		$this->_content = $properties['content'];
		$this->_created = $properties['created'];
		$this->_edited = $properties['edited'];
		
	}

	public function get_array_tpl_vars()
	{
		return array(
			'ID' => $this->_id,
			'PARTNER_ID' => $this->_partner_id,
			'TITLE' => $this->_title,
			'CONTENT' => $this->_content,
			'CREATED' => $this->_created,
			'EDITED' => $this->_edited
		);
	}

}