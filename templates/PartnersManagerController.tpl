# IF USER_CONNECTED #
	# IF HOME #
		# IF USER_IS_PARTNER #
			<div class="success">{@manager.connected_success}</div>
			<ul id="profile-container" class="elements-container columns-2">
				<li class="block">
					<a href="{@manager.edit_link}" title=""><i class="fa fa-wrench fa-2x"></i><span class="profile-element-title">{@manager.edit}</span></a> 
				</li>
				# IF NEWS_MANAGER_ACTIVE #
					<li class="block">
								<a href="{@manager.news_link}" title=""><i class="fa fa-file-text-o fa-2x"></i><span class="profile-element-title">{@manager.create_news}</span></a> 
					</li>
				# ENDIF #
			</ul>
		# ELSE #
			<div class="warning">{@manager.user_not_partner} <a href="{@add_link}">cette page</a></div>
		# ENDIF #
	# ENDIF #

	# IF EDIT #
		# IF USER_IS_PARTNER #
			# IF EDIT_OK #
				<div class="success">{@partner_update_message}</div>
			# ENDIF #
			# INCLUDE edit_form #
		# ELSE #
			<div class="warning">{@manager.user_not_partner} <a href="{@add_link}">cette page</a></div>
		# ENDIF #
	# ENDIF #

	# IF NEWS #
		# IF USER_IS_PARTNER #
			<a href="{@manager.creat_news_link}" class="basic-button">{@manager.create_news_btn}</a>
			<ul>
				# START news #
					<li>{news.TITLE}</li>
				# END news #
			</ul>
		# ELSE #
			<div class="warning">{@manager.user_not_partner} <a href="{@add_link}">cette page</a></div>
		# ENDIF #
	# ENDIF #
# ELSE #
	<div class="error">{@manager.connection_required}</div>
# ENDIF #