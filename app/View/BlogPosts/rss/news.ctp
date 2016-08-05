<?php
	$this->set('documentData', array(
		'xmlns:dc' => 'http://purl.org/dc/elements/1.1/')
	);
	$this->set('channelData', array(
		'title' => 'The Asstereoidiots News and Shows',
		'link' => $this->Html->url('/', true),
		'description' => 'Neues aus Wodenau an der Hoden',
		'language' => 'de-de')
	);

	$items = array();

	foreach ($posts as $post){
		$postTime = strtotime($post['BlogPost']['created']);
		$postLink = array(
			'controller'	=> 'blog_posts',
			'action'		=> 'view',
			$post['BlogPost']['id']
		);

		App::uses('Sanitize', 'Utility');
		$bodyText = preg_replace('=\(.*?\)=is', '', $post['BlogPost']['body']);
		$bodyText = $this->Text->stripLinks($bodyText);
		$bodyText = Sanitize::stripAll($bodyText);
		$bodyText = $this->Text->truncate($bodyText, 400, array('ending' => '&hellip;', 'exact' => false));

		$items[$postTime] = $this->Rss->item(array(), array(
			'title' => $post['BlogPost']['subject'],
			'link' => $postLink,
			'guid' => array('url' => $postLink, 'isPermaLink' => true),
			'description' => $bodyText,
			'creator' => $post['User']['name'],
			'pubDate' => $post['BlogPost']['created']
			)
		);
	}

	foreach ($upcomingShows as $show){
		$postTime = strtotime($show['Show']['created']);
		$postLink = array(
			'controller'	=> 'shows',
			'action'		=> 'view',
			$show['Show']['id']
		);

		App::import('Sanitize');
		$titleText = date('d.m.Y', strtotime($show['Show']['showtime'])).': '.$show['Location']['name'].' '.$show['Location']['city'];
		$titleText = preg_replace('=\(.*?\)=is', '', $titleText);
		$titleText = $this->Text->stripLinks($titleText);
		$titleText = Sanitize::stripAll($titleText);

		$bands = array();
		foreach ($show['Band'] as $band){
			$bands[] = $band['name'];
		}

		$bodyText = "<table><tr><th>Showtime</th><td>".date('d.m.Y.', strtotime($show['Show']['showtime']))."</td></tr>";
		$bodyText .= "<tr valign='top'><th>Location</th><td>";
		$bodyText .= $show['Location']['name']."<br />";
		$bodyText .= $show['Location']['address1']."<br />";
		if (!empty($show['Location']['address2'])){
			$bodyText .= $show['Location']['address2']."<br />";
		}
		$bodyText .= $show['Location']['country']."-".$show['Location']['zip']." ".$show['Location']['city'];
		$bodyText .= "</td></tr>";

		$bandsText = $this->Text->toList($bands, 'and');
		$bandsText = preg_replace('=\(.*?\)=is', '', $bandsText);
		$bandsText = $this->Text->stripLinks($bandsText);
		$bandsText = Sanitize::stripAll($bandsText);

		if (count($bands) > 0){
			$bodyText .= ('<tr><th>rocking with</th><td>'.$bandsText.'</td></tr>');
		}
		$bodyText .= '</table>';

		$items[$postTime] = $this->Rss->item(array(), array(
			'title' => $titleText,
			'link' => $postLink,
			'guid' => array('url' => $postLink, 'isPermaLink' => true),
			'description' => $bodyText,
			'creator' => $show['User']['username'],
			'pubDate' => $show['Show']['created']
			)
		);
	}

	ksort($items);
	foreach ($items as $item){
		echo $item;
	}
?>
