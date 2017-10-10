<section>
	<header>
		<h1>{@module_title}</h1>
	</header>
	<article>
		<p>{@home_message}</p>
		<p><a href="{@add_link}" class="basic-button">{@add_link_message}</a></p>
		<div class="content">
			<table>
				<thead>
					<th width="20%">{@partner_head_logo}</th>
					<th width="40%">{@partner_head_name}</th>
					# IF ORDER_CHOICE #
						<th width="10%">{@partner_head_entry}</th>
						<th width="10%">{@partner_head_out}</th>
					# ENDIF #
				</thead>
				<tbody>
					# START partner #
						<tr>
							<td><a href="{@link_out}{partner.ID}" target="_blank"><img src="{partner.LINK_BANNER}" alt="{partner.NAME}" style="max-width:150px;"></a></td>
							<td style="text-align:left;"><a href="{@link_out}{partner.ID}" target="_blank">{partner.NAME}</a><br /><small><em>{partner.DESCRIPTION}</em></small></td>
							# IF ORDER_CHOICE #
								<td>{partner.ENTRIES}</td>
								<td>{partner.OUTPUTS}</td>
							# ENDIF #
						</tr>
					# END partner #				
				</tbody>
			</table>
		</div>
	</article>
	<footer></footer>
</section>
