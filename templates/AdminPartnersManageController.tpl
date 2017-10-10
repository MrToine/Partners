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
					<th width="10%">{@partner_head_entry}</th>
					<th width="10%">{@partner_head_out}</th>
					<th width="10%">{@partner_head_manage}</th>
				</thead>
				<tbody>
					# START partner #
						<tr>
							<td><a href="{@link_out}{partner.ID}" target="_blank"><img src="{partner.LINK_BANNER}" alt="{partner.NAME}" style="max-width:150px;"></a></td>
							<td style="text-align:left;"><a href="{@link_out}{partner.ID}" target="_blank">{partner.NAME}</a><br /><small><em>{partner.DESCRIPTION}</em></small></td>
							<td>{partner.ENTRIES}</td>
							<td>{partner.OUTPUTS}</td>
							<td>
								<a href="{@partner_edit}/{partner.ID}"><i class="fa fa-edit"></i></a>
								<a href="{@partner_delete}/{partner.ID}"><i class="fa fa-delete"></i></a>
								<a href="mailto:{partner.MAIL}"><i class="fa fa-mail-forward"></i></a>
							</td>
						</tr>
					# END partner #				
				</tbody>
			</table>
		</div>
	</article>
	<footer></footer>
</section>

		