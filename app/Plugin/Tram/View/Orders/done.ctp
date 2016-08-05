<?php echo $this->element('steps', array('step' => 3)); ?>
<div class="row orders order">
	<h2>Fertig!</h2>
</div>
<div class="row orders order">
	<div class="twelve columns">
		<div class="panel">
			<div class="row">
				<div class="twelve columns">
					<p style="text-align:center"><?php echo $this->Html->image('/tram/img/done.jpg'); ?></p>
					<p>
						Vielen Dank f&uuml;r Deine Bestellung! Wir freuen uns sehr, da&szlig; Du mit uns feiern willst!
					</p>
					<h4>Und jetzt?</h4>
					<p>
						Du hast soeben eine E-Mail erhalten, die Deine Bestellung noch einmal best&auml;tigt. Au&szlig;erdem findest Du in dieser E-Mail auch die Bankverbindung, auf die Du bitte den Gesamtbetrag Deiner Bestellung &uuml;berweist. Du erh&auml;ltst dann Dein(e) Ticket(s) mit der Post.
					</p>
					<h4>Alles klar?</h4>
					<p>
						Solltest Du noch irgenwelche Fragen haben oder sollten irgendwelche Probleme beim Bestellvorgang aufgetreten sein, so wende Dich bitte an <?php echo $this->Html->link('mailto:info@the-asstereoidiots.de', 'info@the-asstereoidiots.de'); ?>.
						<dl class="faq">
							<dt>Keine Best&auml;tigngs-Email erhalten?</dt>
							<dd>Schreibe eine E-Mail an info@the-asstereoidiots.de</dd>
							<dt>Keine Post erhalten?</dt>
							<dd><strong>Bitte warte mindestens bis zum 23.05.!</strong> Die Tickets werden gesammelt verschickt. Je nachdem wie lange die Post braucht solltest Du Dein(e) Ticket(s) bis zum 23.05. im Briefkasten haben. Wenn Du am 23.05. immer noch keine Post erhalten hast, wende Dich an uns.</dd>
						</dl>
					</p>
					<p style="text-align:center">
						<?php echo $this->Html->link('Ok, zeig mir noch mal diese geile Startseite', array('action' => 'index'), array('class' => 'large nice black radius button')); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
