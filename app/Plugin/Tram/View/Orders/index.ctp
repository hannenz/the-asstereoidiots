<div class="row">
	<div class="twelve columns">
		<div class="starspacer"></div>
		<h2>F&uuml;r nur 15,-- &euro; erwartet Dich ein Rock'n'Roll Erlebnis der Extraklasse</h2>
	</div>
</div>
<div class="row" id="second-row">
	<div class="three columns">
		<div class="panel">
			<h3>Live Konzert</h3>
			<figure><?php echo $this->Html->image('/tram/img/Tram_Web100.jpg'); ?></figure>
			<p class="fixed-height">
				in der Stra&szlig;enbahn durch die Ulmer City.<br>Echt abgefahren!
			</p>
			<a class="button tiny radius black" href="#" data-reveal-id="detail1">Details</a>
		</div>
		<div class="plus">+</div>
	</div>
	<div class="three columns">
		<div class="panel">
			<h3>Gratis CD</h3>
			<figure><?php echo $this->Html->image('/tram/img/cdcover.jpg'); ?></figure>
			<p class="fixed-height">
				Unsere neue CD &rdquo;Not That Bad At All&ldquo; gibt's gratis beim Einstieg in die Bahn!
			</p>
			<a class="button tiny radius black" href="#" data-reveal-id="detail2">Details</a>
		</div>
		<div class="plus">+</div>
	</div>
	<div class="three columns">
		<div class="panel">
			<h3>Freibier</h3>
			<figure><?php echo $this->Html->image('/tram/img/bier100.png'); ?></figure>
			<p class="fixed-height">
				w&auml;hrend der Fahrt, solange der Vorrat reicht
			</p>
			<a class="button tiny radius black" href="#" data-reveal-id="detail3">Details</a>
		</div>
		<div class="plus">+</div>
	</div>
	<div class="three columns">
		<div class="panel">
			<h3>Gratis EIntritt</h3>
			<figure><?php echo $this->Html->image('/tram/img/rocknroll2.jpg'); ?></figure>
			<p class="fixed-height">After-Tram-Konzert mit Bitchlifter, 5 Horse Rodeo &amp; THE ASSTEREOIDIOTS im Hemperium
			</p>
			<a class="button tiny radius black" href="#" data-reveal-id="detail4">Details</a>
		</div>
	</div>
</div>


<div class="row" id="third-row">
	<div class="eight columns">
		<h2>Tickets</h2>
		<div id="cta" class="panel">
			<?php if ($timeStatus == 'notyet' && $availableTickets > 0): ?>
				<div id="cta-notyet">
					<p>Tickets gibt es <strong>nur</strong> hier auf dieser Website &mdash; aber jetzt noch nicht.<br>Der Vorverkauf startet am <strong>Donnerstag, 10. Mai 2012</strong> um <strong>10:05 Uhr</strong>.</p><p>Das sind noch genau</p>
					<div id="counter" title="<?php echo $timeToGoString; ?>"></div>
					<p id="timer">
						<span id="timer-inner">
							<span class="days togo"><?php echo $togo['days'] ; ?></span> Tage,
							<span class="hours togo"><?php echo $togo['hours']; ?></span> Stunden,
							<span class="minutes togo"><?php echo $togo['minutes']; ?></span> Minuten und
							<span class="seconds togo"><?php echo $togo['seconds']; ?></span> Sekunden!
						</span>
					</p>
				</div>
			<?php endif ?>
			<?php if ($timeStatus == 'yes' && $ticketsLeft > 0): ?>
				<div id="cta-active" class="row">
					<div id="tickets-illu" class="six columns">
						<?php
						echo $this->Html->image('/tram/img/tickets.png');
						echo $this->Html->image('/tram/img/15euro.png', array('id' => 'price'));
						?>
					</div>
					<div id="tickets-button" class="six columns">
						<h4>Hol Dir jetzt Dein Ticket für dieses einmalige Rock'n'Roll-Erlebnis!</h4>
						<p>Streng limitiert und nur hier erh&auml;ltlich.</p>
						<p>Nur noch <span id="amount"><?php echo $ticketsLeft; ?></span> Tickets</p>
						<?php echo $this->Html->link('Jetzt Fahrschein lösen', array('action' => 'order'), array('class' => 'large nice black radius button')); ?>
						<small>Bezahlung per &Uuml;berweisung (Vorkasse), dein Ticket erh&auml;ltst Du mit der Post.</small>
					</div>
				</div>
			<?php endif ?>
			<?php if ($timeStatus == 'closed'): ?>
				<div id="cta-closed">
					<p>Sorry, aber Du bist echt zu sp&auml;t dran &mdash; der Vorverkauf ist bereits geschlossen</p>
				</div>
			<?php endif ?>
			<?php if ($ticketsLeft <= 0):?>
				<div id="cta-soldout" class="row">
					<div class="six columns">
						<h4>Alle weg...</h4>
						<p>Leider sind schon alle Tickets für die Stra&szlig;enbahn ausverkauft &mdash; aber Du hast trotzdem noch die Chance, THE ASSTEREOIDIOTS live und in Farbe zu erleben. Und zwar auf dem After-Tram-Konzert im Hemperium Ulm am 26.05.2012 ab ca. 21:00 Uhr. Als Support mit dabei: Bitchlifter und 5Horse Rodeo.</p>
						<strong>Don't miss it!</strong>
					</div>
					<div class="six columns">
						<a href="#" data-reveal-id="plakat"><?php echo $this->Html->image('/tram/img/Flyer_Hemp.jpg'); ?></a>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="four columns">
		<h2>Weitersagen!</h2>
		<div class="panel">
			<?php echo $this->Html->image('/tram/img/joxe.jpg'); ?>
			<p>Spread the word &mdash; Go tell it on the mountains: Empfehle diese einmalige Veranstaltung auch Deinen Freunden:</p>
			<a target="_blank" name="fb_share" type="button_count" share_url="http://<?php echo $_SERVER['SERVER_NAME'].'/tram'; ?>" href="http://www.facebook.com/sharer.php">Share</a><br><br>
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="Rock'n'Roll Tram THE ASSTEREOIDIOTS" data-lang="de" data-count="none">Twittern</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
</div>

	<div id="detail1" class="container reveal-modal">
		<h3>The ASSTEREOIDIOTS Live in der Stra&szlig;enbahn</h3>
		<div class="row">
			<div class="seven columns">
				<img src="/tram/img/Tram_Web300.jpg" align="left" />
			</div>
			<div class="five columns">
				<p>Echt, in Farbe und in Laut! Die Idiots geben ein einmaliges Konzert in der Ulmer Straßenbahn.</p>
				<p>Einmal Bahnhof &ndash; B&ouml;fingen &ndash; S&ouml;flingen und zur&uuml;ck. Fahrtzeit ca. 1.5h</p>
			</div>
		</div>
	</div>
	<div id="detail2" class="reveal-modal">
		<h3>CD-Release</h3>
		<div class="row">
			<div class="seven columns">
				<img src="/tram/img/cd.jpg" align="left" />
			</div>
			<div class="five columns">
				<p>Die neue Scheibe der ASSTEREOIDIOTS gibts <strong>GRATIS</strong> dazu! 13 gesungene und ungek&uuml;rzte Tracks.</p>
				<p>Hier spielt die Musik!</p>
			</div>
		</div>
	</div>
	<div id="detail3" class="reveal-modal">
		<h3>Paar aufs Maul gef&auml;llig?</h3>
		<div class="row">
			<div class="seven columns">
				<img src="/tram/img/bier.png" align="left" />
			</div>
			<div class="five columns">
				<p>
					Ihr kriegt was auf die Ohren &mdash; und dann noch Paar aufs Maul &mdash; das erfrischende Mate-Br&auml;u <strong>w&auml;hrend der Fahrt solange der Vorrat reicht!</strong>
				</p>
				<p><a href="http://www.paaraufsmaul.de" target="_blank">http://www.paaraufsmaul.de</a></p>
			</div>
		</div>
	</div>
	<div id="detail4" class="reveal-modal">
		<h3>After-Tram-Konzert</h3>
		<div class="row">
			<div class="six columns">
				<img src="/tram/img/Flyer_Hemp.jpg" align="left" />
			</div>
			<div class="six columns">
				<p>Alles geil! Aber da die Fahrt nur 1.5h dauert, und uns das definitiv nicht reicht, geht es hinterher straight on ins Hemperium!</p><p>Dort erwartet Euch ein Konzert in bew&auml;hrter Rock'n'Roll Qualit&auml;t mit <br><strong>5Horse Rodeo</strong> und <strong>Bitchlifter</strong></p><p>&hellip;und natürlich hauen <br><strong>THE ASSTEREOIDIOTS</strong><br> auch noch mal so richtig auf die Kacke!</p>
			</div>
		</div>
	</div>
	<?php echo $this->Html->image('/tram/img/Plakat_Hemp.jpg', array('id' => 'plakat', 'class' => 'reveal-modal')); ?>

<?php ob_start(); ?>
<script>
	$(document).ready(function(){

		$('#timer').hide();
		$('#counter').countdown({
			startTime : $('#counter').attr('title'),
			timerEnd : function() { location.reload(); }
		});
		$('<div class="desc"><div>Tage</div><div>Stunden</div><div>Minuten</div><div>Sekunden</div></div>').insertAfter($('#counter'));
	});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
echo $this->Html->script('/tram/js/jquery.countdown.min', array('inline' => false));
?>


