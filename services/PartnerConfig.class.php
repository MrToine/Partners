<?php
/*##################################################
 *                            Partner.class.php
 *                            -------------------
 *   begin                : October 31, 2014
 *   copyright            : (C) 2014 Anthony VIOLET
 *   ebanner_url                : anthony.violet@outlook.fr
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

class PartnerConfig {

	private $_nb_partners_mini_module,
			$_display_rank,
			$_partner_manager,
			$_news_manager;

	public function get_nb_partners_mini_module(){

		return $this->_nb_partners_mini_module;

	}

	public function get_display_rank(){

		return $this->_display_rank;
		
	}

	public function get_partner_manager(){

		return $this->_partner_manager;
		
	}

	public function get_news_manager(){

		return $this->_news_manager;
		
	}

	public function set_nb_partners_mini_module($nb_partners_mini_module){

		$nb_partners_mini_module = (int) $nb_partners_mini_module;

		if($nb_partners_mini_module > 0){

			$this->_nb_partners_mini_module = $nb_partners_mini_module;
		}

	}

	public function set_display_rank($display_rank){

		$display_rank = (int) $display_rank;

		$this->_display_rank = $display_rank;

	}

	public function set_partner_manager($partner_manager){

		$partner_manager = (int) $partner_manager;
		$this->_partner_manager = htmlspecialchars($partner_manager);

	}

	public function set_news_manager($news_manager){

		$news_manager = (int) $news_manager;
		$this->_news_manager = htmlspecialchars($news_manager);

	}

	public function get_properties()
	{
		return array(
			'nb_partners_mini_module' => $this->get_nb_partners_mini_module(),
			'display_rank' => TextHelper::htmlspecialchars($this->get_display_rank()),
			'partner_manager' => TextHelper::htmlspecialchars($this->get_partner_manager()),
			'news_manager' => TextHelper::htmlspecialchars($this->get_news_manager())
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_nb_partners_mini_module = $properties['nb_partners_mini_module'];
		$this->_display_rank = $properties['display_rank'];
		$this->_partner_manager = $properties['partner_manager'];
		$this->_news_manager = $properties['news_manager'];
		
	}

	public function get_array_tpl_vars()
	{
		return array(
			'NB_PARTNERS_MINI_MODULE' => $this->_nb_partners_mini_module,
			'DISPLAY_RANK' => $this->_display_rank,
			'PARTNER_MANAGER' => $this->_partner_manager,
			'NEWS_MANAGER' => $this->_news_manager
		);
	}
}