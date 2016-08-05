<?php
	$this->set('documentData', array(
		'xmlns:dc' => 'http://purl.org/dc/elements/1.1/')
	);
	$this->set('channelData', array(
		'title' => 'The Asstereoidiots Blog\'n\'Roll',
		'link' => $this->Html->url('/', true),
		'description' => 'Neues aus Wodenau an der Hoden',
		'language' => 'de-de')
	);
	
	foreach ($posts as $post){
		$postTime = strtotime($post['BlogPost']['created']);
		$postLink = array(
			'controller'	=> 'blog_posts',
			'action'		=> 'view',
			$post['BlogPost']['id']
		);
		
		App::import('Sanitize');
		$bodyText = preg_replace('=\(.*?\)=is', '', $post['BlogPost']['body']);
		$bodyText = $this->Text->stripLinks($bodyText);
		$bodyText = Sanitize::stripAll($bodyText);
		$bodyText = $this->Text->truncate($bodyText, 400, '...', true, true);
		
		echo $this->Rss->item(array(), array(
			'title' => $post['BlogPost']['subject'],
			'link' => $postLink,
			'guid' => array('url' => $postLink, 'isPermaLink' => true),
			'description' => $bodyText,
			'creator' => $post['User']['name'],
			'pubDate' => $post['BlogPost']['created']
			)
		);
	}	
?>
