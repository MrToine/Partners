<?php
/*##################################################
 *                            Partner.class.php
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

class Partner {

	private $_id,
			$_user_id,
			$_name,
			$_mail,
			$_password,
			$_description,
			$_link,
			$_link_banner,
			$_entries,
			$_outputsputs;

	public function get_id(){

		return $this->_id;

	}

	public function get_user_id(){

		return $this->_user_id;

	}

	public function get_name(){

		return $this->_name;
		
	}

	public function get_mail(){

		return $this->_mail;

	}

	public function get_password(){

		return $this->_password;

	}

	public function get_description(){

		return $this->_description;
		
	}

	public function get_link(){

		return $this->_link;
		
	}

	public function get_link_banner(){

		return $this->_link_banner;
		
	}

	public function get_entries(){

		return $this->_entries;
		
	}

	public function get_outputs(){

		return $this->_outputs;
		
	}

	public function set_id($id){

		$id = (int) $id;

		if($id > 0){

			$this->_id = $id;

		}
	}

	public function set_user_id($user_id){

		$user_id = (int) $user_id;

		if($user_id > 0){

			$this->_user_id = $user_id;

		}
	}

	public function set_name($name){

		if(is_string($name)){

			$this->_name = htmlspecialchars($name);

		}

	}

	public function set_mail($mail) {

		if(is_string($mail)){

			$this->_mail = htmlspecialchars($mail);

		}

	}

	public function set_password($password) {

		if(is_string($password)){

			$this->_password = htmlspecialchars($password);

		}

	}

	public function set_description($description){

		$this->_description = htmlspecialchars($description);

	}

	public function set_link($link){

		$this->_link = htmlspecialchars($link);

	}

	public function set_link_banner($link_banner){

		$this->_link_banner = htmlspecialchars($link_banner);

	}

	public function set_entries($entries){

		$entries = (int) $entries;

		if(is_int($entries)){

			$this->_entries = htmlspecialchars($entries);

		}

	}

	public function set_outputs($outputs){

		$outputs = (int) $outputs;

		if(is_int($outputs)){

			$this->_outputs = htmlspecialchars($outputs);

		}

	}

	public function get_properties()
	{
		return array(
			'id' => $this->get_id(),
			'user_id' => $this->get_user_id(),
			'name' => TextHelper::htmlspecialchars($this->get_name()),
			'mail' => TextHelper::htmlspecialchars($this->get_mail()),
			'password' => TextHelper::htmlspecialchars($this->get_password()),
			'description' => TextHelper::htmlspecialchars($this->get_description()),
			'link' => TextHelper::htmlspecialchars($this->get_link()),
			'link_banner' => TextHelper::htmlspecialchars($this->get_link_banner()),
			'entries' => (int) $this->get_entries(),
			'outputs' => (int) $this->get_outputs()
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_id = $properties['id'];
		$this->_user_id = $properties['user_id'];
		$this->_name = $properties['name'];
		$this->_mail = $properties['mail'];
		$this->_password = $properties['password'];
		$this->_description = $properties['description'];
		$this->_link = $properties['link'];
		$this->_link_banner = $properties['link_banner'];
		$this->_entries = $properties['entries'];
		$this->_outputs = $properties['outputs'];
		
	}

	public function get_array_tpl_vars()
	{
		return array(
			'ID' => $this->_id,
			'PARTNER_USER_ID' => $this->_user_id,
			'NAME' => $this->_name,
			'MAIL' => $this->_mail,
			'PASSWORD' => $this->_password,
			'DESCRIPTION' => $this->_description,
			'LINK' => $this->_link,
			'LINK_BANNER' => $this->_link_banner,
			'ENTRIES' => $this->_entries,
			'OUTPUTS' => $this->_outputs,
		);
	}

}