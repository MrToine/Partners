<?php
/*##################################################
 *                    PartnersRankModuleMiniMenu.class.php
 *                            -------------------
 *   begin                : November 07, 2014
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

class PartnersRankModuleMiniMenu extends ModuleMiniMenu {

	public function get_default_block()
    {
    	return self::BLOCK_POSITION__LEFT;
    }
 
    public function admin_display($tpl = false)
    {
    	
        return $this->display();
    }
 
    public function display($tpl = false)
    {
        $config = PartnersService::get_config();
    	$tpl = new FileTemplate('partners/partners_mini.tpl');
 
    	// Permet d'assigner les variables tpl au template pour pouvoir ensuite donner un affichage différent selon la colonne où est situé le menu
	    MenuService::assign_positions_conditions($tpl, $this->get_block());
    
	    $lang = LangLoader::get('common', 'partners');

        if($config->get_partner_manager() == "Oui"){
            $update_active = True;
        }else{
            $update_active = False;
        }

	    $tpl->put_all(array(
	    	'MODULE_MENU_TITLE' => $lang['module_title'],
            'ADD_LINK' => $lang['add_link'],
            'ADD_LINK_MESSAGE' => $lang['add_link_message'],
            'LINK_OUT' => $lang['link_out'],
            'URL_LIST_PARTNERS' => $lang['url_list_partners'],
	    	'LINK_LIST_PARTNERS' => $lang['link_list_partners'],
            'UPDATE_ACTIVE' => $update_active,
            'UPDATE_LINK_MESSAGE' => $lang['update_link_message'],
            'UPDATE_LINK' => $lang['update_link'],
            'NEWS_LINK' => $lang['news.link']
	    ));

        $result = PersistenceContext::get_querier()->select_rows(
            PREFIX.'partners', array(
                '*'
            ), 
            'ORDER BY entries DESC LIMIT 0,'.$config->get_nb_partners_mini_module()
        );

        while ($row = $result->fetch())
        {
            $partner = new Partner();
            $partner->set_properties($row);
            
            $tpl->assign_block_vars('partner', $partner->get_array_tpl_vars());
        }

        $result->dispose();

        if($config->get_news_manager() == "Oui"){
            $result_news = PersistenceContext::get_querier()->select_rows(
                PREFIX.'partners_news', array(
                    '*'
                ), 
                'ORDER BY id DESC LIMIT 0, 20'
            );

            while ($row_news = $result_news->fetch())
            {
                $partner_news = new PartnerNews();
                $partner_news->set_properties($row_news);
                $tpl->assign_block_vars('partner_news', $partner_news->get_array_tpl_vars());
            }

            $result_news->dispose();
        }
            
 
	    // Retourne l'affichage du menu
	    return $tpl->render();
    }

}