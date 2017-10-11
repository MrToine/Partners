<?php
/*##################################################
 *                                 BlogPostController.class.php
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

class PartnersNewsController extends ModuleController {
	
	private $lang,
			$view,
			$news_id;

	public function execute(HTTPRequestCustom $request){

		$this->news_id = $request->get_getint('news_id');

	 	$this->init();

	 	$result = PartnersService::get_news_id($this->news_id);

		$news = new PartnerNews();
		$news->set_properties($result);

		/* Comments */ 

		$comments_topic = new BlogCommentsTopic();
		$comments_topic->set_id_in_module($news->get_id());
		$comments_topic->set_url(BlogUrlBuilder::display_comments_posts($news->get_id()));

		$this->view->put_all(array(
				//->News
				'ID' => $news->get_id(),
				'TITLE' => $news->get_title(),
				'CONTENT' => $news->get_content(),
				'CREATED' => $news->get_content(),
				//-> Partner
				'PARTNER_ID' => $news->get_partner_id(),
				'PARTNER_LINK' => $result['link'],
				'BANNER_LINK' => $result['link_banner'],
				'PARTNER_NAME' => $result['name'],
				'ENTRIES' => $result['entries'],
				'OUTPUTS' => $result['outputs'],
				'COMMENTS' => $comments_topic->display()

		));

	 	return $this->generate_response();

	}	

	private function init(){
		$this->lang = LangLoader::get('common', 'partners');
		$this->view = New FileTemplate('partners/PartnersNewsController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function generate_response(){
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], PartnersUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['news_page'], PartnersUrlBuilder::news()->rel());
		
		return $response;
	}
}