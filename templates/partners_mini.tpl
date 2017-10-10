<section>
	<div class="module-mini-container">
	<head>
		<div class="module-mini-top">
			<h5 class="sub-title">{MODULE_MENU_TITLE}</h5>
		</div>
	</head>
	<article>
		<div class="module-mini-contents">
			<ul class="menu-vertical-0 menu-vertical">
				# START partner #
					<li style="margin:5px;text-align:center;"><a href="{LINK_OUT}{partner.ID}"><img src="{partner.LINK_BANNER}" alt="{partner.NAME}" style="max-width:100px;" /></a></li>
				# END partner #
			</ul>
			# START partner_news #
				<p>{partner_news.TITLE}</p>
			# END partner_news #
			<br />
			<p><a href="{ADD_LINK}" class="basic-button">{ADD_LINK_MESSAGE}</a></p>
			# IF UPDATE_ACTIVE #
				<p><a href="{UPDATE_LINK}" class="basic-button">{UPDATE_LINK_MESSAGE}</a></p>
			# ENDIF #
			
			<a href="{URL_LIST_PARTNERS}">{LINK_LIST_PARTNERS}</a>
		</div>
	</article>
	<footer>
		<div class="module-mini-bottom">
		</div>
	</div>
	</footer>
</section>