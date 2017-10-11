<content>
	<section>
		<div class="options info">
			<p><img src="{BANNER_LINK}" alt="{PARTNER_NAME}" style="max-width:350px;"></p>
			<p><center><strong>{PARTNER_NAME}</strong></center></p>
			<ul>
				<li>{@news.visitors_out}{OUTPUTS}</li>
				<li>{@news.visitors_entry}{ENTRIES}</li>
			</ul>
			<a href="{@link_out}{PARTNER_ID}" class="basic-button alt"><i class="fa fa-globe"></i> {@news.visit_button}</a>		
		</div>
		<header>
			<h1>{TITLE}</h1>
		</header>
		<article>
			<p>{CONTENT}</p>
		</article>
		<footer></footer>
	</section>
</content>	
<section>
	<header>
		<h1>Commentaires</h1>
		<div class="more"></div>
		# INCLUDE  COMMENTS #
	</header>
</section>