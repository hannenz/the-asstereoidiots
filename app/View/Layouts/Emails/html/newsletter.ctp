<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

<table width="100%" bgcolor="#cccccc" cellpadding="0" cellspacing="0">
	<tr valign="top" align="center">
		<td>
			<table width="450" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
				<tr>
					<td>
						<img src="cid:newsletter-header-gif" alt="THE ASSTEREOIDIOTS" width="450" height="212" />
					</td>
				</tr>
				<tr>
					<td style="padding: 30px 15px 30px 15px; font-size:16px;line-height:22px;">
						<?php echo $content_for_layout; ?>
					</td>
				</tr>
				<tr>
					<td>
						<img style="display:block; margin-bottom: 30px;" src="cid:newsletter-signature-gif" alt="Eure Asses!" width="450" height="94" />
					</td>
				</tr>
				<?php if (!empty($upcomingShows)): ?>
					<tr>
						<td>
							<img src="cid:newsletter-upcoming-shows-gif" alt="Anstehende Shows" width="450" height="54" />
						</td>
					</tr>
					<tr>
						<td style="padding:15px">

							
							<table cellpadding="'0" cellspacing="0" width="100%">
								<?php foreach ($upcomingShows as $show): ?>
									<tr>
										<td style="vertical-align:top; text-align:left; height:100px">
											<a href="http://<?php echo env('SERVER_NAME'); ?>/shows/<?php echo $show['Show']['slug']; ?>">
												<img style="display:block;height:80px;width:auto" src="cid:<?php echo $show['Show']['bill_cid']; ?>" alt="" height="80" alt="" />
											</a>
										</td>
										<td style="vertical-align:top; text-align:left; font-size:16px; line-height:22px;">
											<strong><?php echo strftime('%a, %d.%B %Y', strtotime($show['Show']['showtime'])); ?></strong><br>
											<?php echo $show['Location']['full_name']; ?><br>
											<a style="color:#BD2F29; text-decoration:none; font-weight:normal;" href="http://<?php echo env('SERVER_NAME'); ?>/shows/<?php echo $show['Show']['slug']; ?>">👉 Details</a>
										</td>
									</tr>
								<?php endforeach ?>
							</table>
						</td>
					</tr>
				<?php endif ?>
				<tr>
					<td style="padding-top:15px; border-top:1px solid #1a1a1a;">
						<p style="font-family:sans;color:#707070; font-size:12px; line-height:16px; text-align:center; text-transform:uppercase; padding:15px 15px 45px 15px;">
							Wenn du keinen Newsletter mehr erhalten möchtest, <a href="http://<?php echo env('SERVER_NAME'); ?>/subsribers/unsubscribe/<?php echo $email; ?>">klicke hier</a>, um dich auszutragen
						</p>

						<table cellspacing="4" cellpadding="0" width="100%">
							<tr>
								<td><a style="display:block; width:100%; height:100%; background-color:#36528C; color:#ffffff; font-size:12px; line-height:22px; text-align:center; text-transform:uppercase; text-decoration:none" href="#">Facebook</a></td>
								<td><a style="display:block; width:100%; height:100%; background-color:#C24232; color:#ffffff; font-size:12px; line-height:22px; text-align:center; text-transform:uppercase; text-decoration:none" href="#">Google+</a></td>
								<td><a style="display:block; width:100%; height:100%; background-color:#503251; color:#ffffff; font-size:12px; line-height:22px; text-align:center; text-transform:uppercase; text-decoration:none" href="#">Jamendo</a></td>
								<td><a style="display:block; width:100%; height:100%; background-color:#BD2F29; color:#ffffff; font-size:12px; line-height:22px; text-align:center; text-transform:uppercase; text-decoration:none" href="#">YouTube</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<a href="http://www.the-asstereoidiots.de"><img src="cid:newsletter-footer-gif" alt="www.the-asstereoidiots.de" width="450" height="51" /></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>
