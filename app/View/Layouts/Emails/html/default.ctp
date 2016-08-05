<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

<table width="100%" bgcolor="#cccccc" cellpadding="10" cellspacing="0">
	<tr valign="top" align="center">
		<td>
			<table width="500" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
				<tr>
					<td>
						<img src="cid:logo-gif" alt="THE ASSTEREOIDIOTS" width="500" height="122" />
					</td>
				</tr>
				<tr>
					<td style="padding: 15px">
						<?php echo $content_for_layout; ?>
					</td>
				</tr>
				<?php if (!empty($upcomingShows)): ?>
				<tr>
					<td style="padding:15px">
						<hr style="border:0; border-top:1px solid #888; margin:20px 0" />
						<table cellpadding="'0" cellspacing="0" width="100%">
							<caption style="font-size:16px; margin:10px 0 20px 0; text-transform:uppercase; color:#111">★★★ Anstehende Shows ★★★</caption>
							<?php foreach ($upcomingShows as $show): ?>
								<tr>
									<td style="vertical-align:top; text-align:left; height:100px">
										<a href="http://<?php echo env('SERVER_NAME'); ?>/shows/<?php echo $show['Show']['slug']; ?>">
											<img style="display:block;height:80px;width:auto" src="cid:<?php echo $show['Show']['bill_cid']; ?>" alt="" height="80" alt="" />
										</a>
									</td>
									<td style="vertical-align:top; text-align:left">
										<strong><?php echo strftime('%a, %d.%B %Y', strtotime($show['Show']['showtime'])); ?></strong><br>
										<?php echo $show['Location']['full_name']; ?>
										<a style="color:#c00000; text-decoration:none" href="http://<?php echo env('SERVER_NAME'); ?>/shows/<?php echo $show['Show']['slug']; ?>">👉 Details</a>
									</td>
								</tr>
							<?php endforeach ?>
						</table>
						<hr style="border:0; border-top:1px solid #888; margin:20px 0" />
					</td>
				</tr>
				<?php endif ?>
				<tr>
					<td style="padding:15px; border-top:1px solid #ddd; color:#888; font-size:11px; text-align:left">
						<?php echo strftime('%F %T'); ?> <?php echo $_SERVER['SERVER_NAME']; ?>
					</td>
			</table>
		</td>
	</tr>
</table>

</body>
</html>
