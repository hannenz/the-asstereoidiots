<div class="row">
	<div class="twelve columns">
		<div class="panel">
			<div style="text-align:right">
				Daten-Export:
				<?php echo $this->Html->link('Download XML', array('action' => 'index.xml'), array('class' => 'tiny blue radius button')); ?>
				<?php echo $this->Html->link('Download CSV', array('action' => 'export.csv'), array('class' => 'tiny blue radius button')); ?>
			</div>
			<table class="admin orders index" style="width:100%">
				<thead>
					<?php
					echo $this->Html->tableHeaders(array(
						$this->Paginator->sort('created', 'Datum'),
						$this->Paginator->sort('amount', 'Anz.'),
						$this->Paginator->sort('code', 'Code'),
						$this->Paginator->sort('lastname', 'Name'),
						$this->Paginator->sort('email', 'E-Mail'),
						$this->Paginator->sort('zip', 'Anschrift'),
						$this->Paginator->sort('payed', 'Bezahlt'),
						$this->Paginator->sort('shipped', 'Verschickt'),
						'Aktion'
					));
					?>
				</thead>

				<tbody>
					<?php
					$total = 0;
					foreach ($orders as $order){
						echo $this->Html->tableCells(array(
							strftime('%x %H:%M', strtotime($order['Order']['created'])),
							$order['Order']['amount'],
							$order['Order']['code'],
							join(', ', array($order['Order']['lastname'], $order['Order']['firstname'])),
							$order['Order']['email'],
							join('<br>', array($order['Order']['address'], $order['Order']['zip'].' '.$order['Order']['city'])),
							$this->Html->link(empty($order['Order']['payed']) ? 'nein' : strftime('%x', strtotime($order['Order']['payed'])), array('action' => 'toggle', $order['Order']['id'], 'payed')),
							$this->Html->link(empty($order['Order']['shipped']) ? 'nein' : strftime('%x', strtotime($order['Order']['shipped'])), array('action' => 'toggle', $order['Order']['id'], 'shipped')),
							$this->Html->link('löschen', array('action' => 'delete', $order['Order']['id']), array('class' => 'tiny red radius button'), 'Wirklich löschen?')
						));
						$total += $order['Order']['amount'];
					}
					?>
					<tr>
						<td><strong>Gesamt</strong></td>
						<td><strong><?php echo $total; ?></strong></td>
						<td colspan="6"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
