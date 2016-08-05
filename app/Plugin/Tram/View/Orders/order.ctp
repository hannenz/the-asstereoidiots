<?php echo $this->element('steps', array('step' => 1)); ?>
<div class="row orders order">
	<h2>Ticket bestellen</h2>
</div>
<div class="row orders order">
	<div class="eight columns">
		<div class="panel">
			<?php
			echo $this->Form->create('Order', array('action' => 'order', 'class' => 'nice', 'inputDefaults' => array('div' => array('class' => 'form-field input'))));
			?>
			<fieldset>
				<legend>Hol Dir Dein Ticket!</legend>
				<div class="row">
					<?php
					echo $this->Session->flash();
					echo $this->Form->input('amount', array(
						'label' => 'Anzahl Tickets',
						'class' => 'input-select large',
						'div' => array('class' => 'form-field input select twelve columns'),
						'type' => 'select',
						'options' => array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5')
					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('firstname', array(
						'label' => 'Vorname',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text six columns'),
						'placeholder' => 'Paul'
					));
					echo $this->Form->input('lastname', array(
						'label' => 'Nachname',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text six columns'),
						'placeholder' => 'Penis'
					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('address', array(
						'label' => 'Straße und Hausnummer',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text twelve columns'),
						'placeholder' => 'Bahnstraße 12'

					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('zip', array(
						'label' => 'PLZ',
						'class' => 'input-text small',
						'div' => array('class' => 'form-field input text four columns'),
						'placeholder' => '54321'
					));
					echo $this->Form->input('city', array(
						'label' => 'Stadt',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text eight columns'),
						'placeholder' => 'Wodenau a. d. Hoden'
					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('phone', array(
						'label' => 'Telefon (Keine Pflicht, aber sinnvoll, falls was schief läuft. Wenn alles gut läuft, rufen wir nicht an)',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text twelve columns'),
						'type' => 'phone',
						'placeholder' => '0123-4567890123'
					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('email', array(
						'label' => 'E-Mail Adresse',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text six columns'),
						'type' => 'email',
						'placeholder' => 'email@example.com'
					));
					echo $this->Form->input('email2', array(
						'label' => 'E-Mail Adresse bitte wiederholen',
						'class' => 'input-text expand',
						'div' => array('class' => 'form-field input text six columns'),
						'type' => 'email',
						'placeholder' => 'email@example.com'
					));
					?>
				</div>
				<div class="row">
					<?php
					echo $this->Form->input('confirmed', array(
						'label' => 'Ja, ich hab <a href="#" data-reveal-id="agb">das hier</a> gelesen und bin mit allem einverstanden',
						'type' => 'checkbox',
						'class' => 'input-checkbox',
						'div' => array('class' => 'form-field input checkbox twelve columns')
					));
					echo $this->Form->input('newsletter', array(
						'label' => 'Ja, schickt mir halt auch euren albernen Newsletter, wenns unbedingt sein muss...',
						'type' => 'checkbox',
						'class' => 'input-checkbox',
						'div' => array('class' => 'form-field input checkbox twelve columns')
					));
					?>
				</div>
				<small>Die mit einem Stern (*) gekennzeichneten Felder müssen ausgefüllt werden.</small>
			</fieldset>
			<div class="row">
				<?php
				echo $this->Html->div('six columns', $this->Html->link('Abbrechen', array('action' => 'index'), array('class' => 'small red radius button')));
				echo $this->Html->div('six columns', $this->Form->submit('Fahrschein lösen', array('class' => 'medium black radius nice button')), array('style' => 'text-align:right'));
				echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
	<div class="four columns">
		<div class="panel">
			<h3>So einfach geht&apos;s</h3>
			<ol>
				<li>Bestellformular ausf&uuml;llen</li>
				<li>Bestellung best&auml;tigen</li>
				<li>E-Mail checken</li>
				<li>Kohle &uuml;berweisen</li>
				<li>Dein(e) Ticket(s) bekommst Du mit der Post</li>
			</ol>
			<h3>Alles klar?</h3>
			<p>Alle Infos zum Ticket, Facts &amp; Conditions:<br> <?php echo $this->Html->link('Hier klicken', '#', array('class' => '', 'data-reveal-id' => 'agb'));?></p>
			<h3>Noch Fragen?</h3>
			<p>Wenn Du noch irgendwas wissen willst, wenn Du Probleme beim Bestellvorgang hast oder wenn Du sonst noch irgendwas los werden willst, schreib einfach eine E-Mail an <?php echo $this->Html->link('info@the-asstereoidiots.de', 'mailto:info@the-asstereoidiots.de'); ?>.</p>
		</div>
	</div>
</div>


		<div id="agb" class="reveal-modal">
			<h4>Hier noch mal alles Wichtige!</h4>
			<ul>
				<li>
					Das Ticket kostet 15,-- &euro; und beinhaltet:
					<ol>
						<li>Eintritt in die Stra&szlig;enbahn, ca. 1.5h Fahrt mit Live-Konzert</li>
						<li>Ein Exemplar der neuen CD THE ASSTEREOIDIOTS &ndash; Not That Bad At All</li>
						<li>Freibier w&auml;hrend der Fahrt solange der Vorrat reicht</li>
						<li>Freier Eintritt zum After-Tram-CD-Release-Konzert im Hemperium</li>
					</ol>
				</li>
				<li>Du musst:
					<ol>
						<li>15,-- &euro; pro Ticket &uuml;berweisen. Die Bankverbindung bekommst Du mit der Bestellbest&auml;tigung per E-Mail.</li>
						<li>P&uuml;nktlich sein: Samstag, 26. Mai 2012 um 19:30 an der Stra&szlig;enbahnhaltestelle Ulm Hauptbahnhof. Die Bahn wartet nicht!! Wer zu sp&auml;t kommt hat wirklich Pech gehabt!</li>
						<li>Dich anst&auml;ndig verhalten in der Bahn.</li>
						<li>Andere Getr&auml;nke als Bier selber mitbringen, wenn gew&uuml;nscht.</li>
					</ol>
				</li>
			</ul>
		</div>
