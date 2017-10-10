<?php
/*##################################################
 *                            PartnersDeleteController.class.php
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

class AdminPartnersDeleteController extends ModuleController
{	
	public function execute(HTTPRequestCustom $request)
	{
		$partner_id = $request->get_getint('partner_id');

		if(PersistenceContext::get_querier()->count(PREFIX.'partners', 'WHERE id=:id', array('id' => $partner_id)) != 0){
		
			PersistenceContext::get_querier()->delete(PREFIX.'partners', 'WHERE id=:id', array(
				'id' => $partner_id
			));
			

		}

		AppContext::get_response()->redirect(PartnersUrlBuilder::manage_partners());
	}
}
?>