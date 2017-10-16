<div class="module-mini-container">
	<head>
		<div class="module-mini-top">
			<h5 class="sub-title">{MODULE_MENU_TITLE}</h5>
		</div>
	</head>
		<div class="module-mini-contents">
			<ul class="menu-vertical-0">
				# START partner #
					<li style="text-align:center;list-style:none;"><a href="{LINK_OUT}{partner.ID}"><img src="{partner.LINK_BANNER}" alt="{partner.NAME}" style="max-width:150px;" /></a></li>
				# END partner #
			</ul>
			# START partner_news #
				<p><a href="{NEWS_LINK}{partner_news.ID}">{partner_news.TITLE}</a></p>
			# END partner_news #
			<br />
			<p><a href="{ADD_LINK}" class="basic-button">{ADD_LINK_MESSAGE}</a></p>
			# IF UPDATE_ACTIVE #
				<p><a href="{UPDATE_LINK}" class="basic-button">{UPDATE_LINK_MESSAGE}</a></p>
			# ENDIF #
			
			<a href="{URL_LIST_PARTNERS}">{LINK_LIST_PARTNERS}</a>
		</div>
	<div class="module-mini-bottom"></div>
</div>