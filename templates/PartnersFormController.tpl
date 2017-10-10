<section>
	<header>
		
	</header>
	<article>
		# IF C_EDIT #
			# IF C_RESULT #

				<div class="success">{@partner_update_message}</div>

			# ELSE #

				# INCLUDE form #

			# ENDIF #
		# ELSE #
			# IF USER_IS_PARTNER #
				<div class="error">{@user_is_partner}</div>
			# ELSE #
				# IF PARTNER_EXIST #
					<div class="error">{@partner_exist}</div>
					# INCLUDE form #
				# ELSE #
					# IF C_RESULT #

						<div class="success">{@add_success}</div>
						<hr />
						<p class="warning">{@add_notice}</p>
						<br />
						<a href="{@link_entry}{LAST_ID}"><img src="{@link_my_banner}" /></a>
						<br />
						{CODE_LINK}

					# ELSE #

						{@add_message}

						# INCLUDE form #

					# ENDIF #
				# ENDIF #
			# ENDIF #
		# ENDIF #
	</article>
	<footer>
		
	</footer>
</section>