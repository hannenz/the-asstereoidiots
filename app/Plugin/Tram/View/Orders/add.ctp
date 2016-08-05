<?php echo $this->element('steps', array('step' => 2)); ?>
<div class="row orders add">
	<h2>Bestellung best&auml;tigen</h2>
</div>
<div class="row">
	<div class="twelve columns">
		<div class="panel">
			<p>Bitte pr&uuml;fe noch einmal Deine Angaben, bevor Du Deine Bestellung verbindlich abschickst.</p>
			<?php extract ($this->request->data); ?>
			<div class="row">
				<div class="six columns">
				<h4>Bestellung</h4>
					<table>
						<thead>
							<tr>
								<th>Stk.</th>
								<th>Artikel</th>
								<th>Preis</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $Order['amount']; ?></td>
								<td>Ticket: &rdquo;Rock'n'Roll Tram&ldquo; <small>26.05.2012 19:30 Ulm Hbf</small></td>
								<td>15,00 &euro;</td>
							</tr>
							<tr>
								<td></td>
								<td><strong>Summe</strong></td>
								<td><strong><?php printf('%.2f', $Order['amount'] * 15); ?> &euro;</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="three columns">
					<h4>Lieferanschrift</h4>
					<p>
						<?php echo $Order['firstname']; ?> <?php echo $Order['lastname']; ?><br>
						<?php echo $Order['address']; ?><br>
						<?php echo $Order['zip']; ?> <?php echo $Order['city']; ?><br>
					</p>
				</div>
				<div class="three columns">
					<h4>E-Mail</h4>
					<p>
						<?php echo $Order['email']; ?>
					</p>
					<?php
					if ($Order['newsletter']){
						echo $this->Html->tag('p', 'Toll, daß Du unseren Newsletter abonniert hast :)');
						}
					?>
				</div>
			</div>
					<?php
			echo $this->Form->create('Order', array('action' => 'add', 'class' => 'nice', 'inputDefaults' => array('div' => array('class' => 'form-field input'))));
			echo $this->Form->input('amount', array(
				'label' => 'Anzahl Tickets',
				'class' => 'input-select large',
				'div' => array('class' => 'form-field input select twelve columns'),
				'type' => 'hidden',
				'options' => array(1, 2, 3, 4, 5)
			));
			echo $this->Form->input('firstname', array(
				'label' => 'Vorname',
				'class' => 'input-text medium',
				'div' => array('class' => 'form-field input text six columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('lastname', array(
				'label' => 'Nachname',
				'class' => 'input-text medium',
				'div' => array('class' => 'form-field input text six columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('address', array(
				'label' => 'Adresse',
				'class' => 'input-text expand',
				'div' => array('class' => 'form-field input text twelve columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('zip', array(
				'label' => 'PLZ',
				'class' => 'input-text small',
				'div' => array('class' => 'form-field input text four columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('city', array(
				'label' => 'Stadt',
				'class' => 'input-text expand',
				'div' => array('class' => 'form-field input text eight columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('email', array(
				'label' => 'E-Mail Adresse',
				'class' => 'input-text expand',
				'div' => array('class' => 'form-field input text twelve columns'),
				'type' => 'hidden'
			));
			echo $this->Form->input('confirmed', array(
				'label' => 'Ja, ich hab alles gelesen und bin mit allem einverstanden',
				'type' => 'hidden',
				'class' => 'input-checkbox',
				'div' => array('class' => 'form-field input checkbox six columns'),
				'value' => '1'
			));
			echo $this->Form->input('newsletter', array(
				'label' => 'Ja, schickt mir halt auch euren buckligen Newsletter, wenns unbedingt sein muss...',
				'type' => 'hidden',
				'class' => 'input-checkbox',
				'div' => array('class' => 'form-field input checkbox six columns')
			));
			echo $this->Html->link('Oh no! Abbrechen', array('action' => 'order'), array('id' => 'order-cancel-button', 'class' => 'small red radius button'));
			echo $this->Form->submit('YEAH! Bestellen jetzt!', array('id' => 'order-confirm-button', 'class' => 'large green radius nice button'));
			?>
			<div id="dontyeah">Deine Bestellung ist verbindlich. Don't click Yeah if you don't mean it!</div>
			<?php
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>
