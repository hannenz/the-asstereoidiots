<h2><?php echo __('Booking'); ?></h2>
<div class="vcard">
	<?php
	echo $this->Html->div('fn org', 'The Asstereoidiots');
	echo $this->Html->div('adr',
		$this->Html->link(
			'http://www.the-asstereoidiots.de', 'http://www.the-asstereoidiots.de',
			array('class' => 'extended-address')
		)
	);
	echo $this->Html->div('email',
		$this->Html->link(
			'info@the-asstereoidiots.de', 'mailto:info@the-asstereoidiots.de'
		)
	);
	echo $this->Html->div('tel', '+49&thinsp;(0)&thinsp;731&thinsp;&ndash;&thinsp;270&thinsp;909&thinsp;55');
	echo $this->Html->div('tel', '+49&thinsp;(0)&thinsp;176&thinsp;&ndash;&thinsp;220&thinsp;496&thinsp;89');
	?>
	<p>

	<?php
	echo $this->Html->div('social', 
		$this->Html->link('Facebook', 'https://www.facebook.com/theasstereoidiots') . ' | ' . 
		$this->Html->link('Google+', 'https://plus.google.com/b/105803995139839983242/105803995139839983242/posts')
	);
	?>
	</p>
</div>
