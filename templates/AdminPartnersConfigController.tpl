# IF FORM_OK #
	<div class="success">{@config.success}</div>
# ENDIF #
# INCLUDE form_general #
<div class="success">
	{@donation}<br />
	<a href="mailto:{@mail.creator.module">Me contacter par mail</a>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="YDTURCBBF53M4">
		<input type="image" src="https://www.paypalobjects.com/fr_FR/BE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne" target="_bank">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>
<iframe title="iframe" frameborder="0" src="http://univers-toine.esy.es/modulesPHPBOOST/MyPartners/version.html" whidth="200" height="50">
  <p>Votre Navigateur est impatible avec la balise iframe.</p>
</iframe>