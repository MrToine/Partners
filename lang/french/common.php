<?php
/*##################################################
 *                            common.php
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


 ####################################################
 #						French						#
 ####################################################

$lang = array(
	// Titre de pages
	'module_title' => 'Partenaires',
	'add_page' => 'Ajouter',
	'manager_page' => 'Mon espace partenaire',

	// Gestion
	'partners_configuration' => 'Configuration du module',
	'partners_management' => 'Gestion des partenaires',
	'partners_update_banner' => 'Modifier mon logo',
	'partners_add' => 'Ajouter un partenaire',
	'partner_head_manage' => 'Actions',
	'partner_edit' => PartnersUrlBuilder::edit()->absolute(),
	'partner_delete' => PartnersUrlBuilder::delete()->absolute(),
	'update_banner_success' => 'Votre logo à bien été mis à jour. Si l\'image n\'a pas été actualiser, attendez un peu.',
	'update_banner_error' => 'Un erreur est survenue, votre logo n\'a pas été enregistré.',
	'my_banner' => '<div class="notice">Si vous rencontrez des problèmes d\'upload pour votre logo, vous pouvez le modifier à la main en écrasant le fichier banner.png dans le dossier <strong>partners</strong>. <span style="color:red">Attention ! </span> Ne modifiez pas le nom du logo.</div>Mon logo actuel :',
	'update_message' => '',
	'partner_update_message' => 'Le partenaire à bien été modifier !',

	// Liens entrées/sorties
	'link_entry' => PartnersUrlBuilder::link_entry()->absolute(),
	'link_out' => PartnersUrlBuilder::link_out()->absolute(),

	// Informations sur ma bannière
	'link_my_banner' => HOST.'/partners/banner.png',
	
	//messages et liens
	'home_message' => 'Voici les différents partenaires du site. Si vous souhaitez devenir partenaire, cliquez sur "Devenir Partenaire". Les partenaires sont classés au nombre d\'entrées décroissantes. Les 5 premiers sont affichés sur le menu site.',
	'add_link' => PartnersUrlBuilder::add()->absolute(),
	'add_link_message' => 'Devenir partenaire',
	'update_link' => PartnersUrlBuilder::partner_manager('home')->absolute(),
	'update_link_message' => 'Mon espace Partenaire',

	//tableau
	'partner_head_logo' => 'Logo',
	'partner_head_name' => 'Partenaire',
	'partner_head_entry' => 'Entrées',
	'partner_head_out' => 'Sorties',

	//Module mini
	'url_list_partners' => PartnersUrlBuilder::home()->absolute(),
	'link_list_partners' => 'Voir tous nos partenaires',

	// Ajout de partenaire
	'add_message' => 'Vous allez faire une demande de partenariat avec le site. Pour terminer la demande, merci de remplir le formulaire ci-dessous :',
	'add_success' => 'Vous avez bien été ajouter à la liste de nos partenaires.',
	'add_notice' => 'Pour que votre site soit référencé dans le classement, vous devez ajouter ce code sur votre site. Il permet au classement de bien prendre en compte votre site. 
	
	Attention : Si vous modifiez ce code ou que vous ne l\'utilisez pas, le site ne pourra pas prendre en compte le nombre de vsiteurs que vous lui envoyé.',

	// Formulaire
	'form_name' => 'Nom de votre site',
	'form_name_desc' => 'Indiquez le nom de votre site web',

	'form_mail' => 'Votre email',
	'form_mail_desc' => 'Indiquez votre email de contact',

	'form_link' =>'Url de votre site' ,
	'form_link_desc' => 'Indiquez l\'url de votre site web',

	'form_link_banner' => 'Url de votre logo',
	'form_link_banner_desc' => 'Indiquez l\'url de votre logo',

	'form_description' => 'Faites une petite description de votre site',
	'partner_exist' => 'Un partenaire existe déjà avec cette adresse email.',
	'user_is_partner' => 'Vous avez déjà souscris un partenariat avec le site.',

	##admin form
	'config.nb_partners_mini_module' => 'Nombre de partenaires à afficher dans le mini module',
	'config.select_nb_partners_mini_module' => array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10'
	),
	'config.display_rank' => 'Générer un classement de partenaires ?',
	'config.display_rank.yes' => 'Oui',
	'config.display_rank.no' => 'Non',
	'config.partner_manager' => 'Les partenaires peuvent-ils gérer leurs liens ?',
	'config.partner_manager.yes' => 'Oui',
	'config.partner_manager.no' => 'Non',
	'config.news_manager' => 'Les partenaires peuvent-ils créer des actus sur votre site ?',
	'config.news_manager.yes' => 'Oui',
	'config.news_manager.no' => 'Non',
	'config.success' => 'Les modifications du module ont bien été enregistrés.',

	//Manager partner
	'manager.form_mail' => 'Email',
	'manager.form_mail_desc' => 'Indiquez votre email utiliser lors de la demande de partenariat',
	'manager.form_password' => 'Mot de passe',
	'manager.form_password_desc' => 'Indiquez le mot de passe qui vous à été transmis lors de votre inscription',
	'manager.connected_success' => 'Connecté avec succès !',
	'manager.edit' => 'Editer mes informations',
	'manager.edit_link' => PartnersUrlBuilder::partner_manager('edit')->absolute(),
	'manager.create_news' => 'Créer une niouze',
	'manager.news_link' => PartnersUrlBuilder::partner_manager('news')->absolute(),
	'manager.connection_required' => 'Pour pouvoir gérer votre espace partenaire vous devez être inscrit au site.',
	'manager.user_not_partner' => 'Attention ! Vous devez être partenaire pour accèder à cette page. Vous pouvez bien entendu, faire la demande sur',
	'manager.create_news_btn' => 'Créer une news partenaire',
	'manager.creat_news_link' => PartnersUrlBuilder::create_news()->absolute(),
	// FORM NEWS PARTNER
	'manager.title_form_news' => 'Titre',
	'manager.title_form_news_desc' => 'Indiquez le titre de votre news',
	'manager.content_form_news' => 'Contenu de la niouz',
	'manager.news_publied' => 'La news à été créer avec succès. Elle est désormais publier sur le site.',

	// Erreurs
	'partner_not_exists' => '<div class="error">Le partenaire n\'existe pas !<br/>Vous aller être rediriger vers l\'accueil du site...</div>',

	//Divers
	'donation' => 'Si le module vous plait, vous pouvez me soutenir en faisant un petit dons via PayPal.',
	'VERSION' => '',

);