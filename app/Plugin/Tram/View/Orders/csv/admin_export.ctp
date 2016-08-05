<?php

echo join(';', array('Id', 'Code', 'E-Mail', 'Datum', 'Vorname', 'Nachname', 'Adresse', 'PLZ', 'Stadt', 'Anzahl', 'Bezahlt', 'Verschickt'));
echo "\n";

foreach ($orders as $order){
	echo join(';', array(
		'"'.$order['Order']['id'].'"',
		'"'.$order['Order']['code'].'"',
		'"'.$order['Order']['email'].'"',
		'"'.$order['Order']['created'].'"',
		'"'.$order['Order']['firstname'].'"',
		'"'.$order['Order']['lastname'].'"',
		'"'.$order['Order']['address'].'"',
		'"'.$order['Order']['zip'].'"',
		'"'.$order['Order']['city'].'"',
		'"'.$order['Order']['amount'].'"',
		'"'.$order['Order']['payed'].'"',
		'"'.$order['Order']['shipped'].'"'
	));
	echo "\n";
}
?>
