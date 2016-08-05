<div class="list-item-content">
	<h2><?php echo $this->Html->link($post['BlogPost']['subject'], !empty($post['BlogPost']['slug']) ? '/blog/'.$post['BlogPost']['slug'] : '/blog/'.$post['BlogPost']['id']); ?></h2>
	<?php
		if (!empty($post['BlogPost']['image'])){
			echo $this->Html->image('blog' . DS . $post['BlogPost']['image'], array('class' => 'blog-post-image'));
		}
	?>
	<p class="news-body"><?php echo ($post['BlogPost']['body']); ?></p>
	<p class="news-meta">
		<?php
		echo __("%s, %s, %u comments", $post['User']['name'], $this->TimeL8n->niceShort($post['BlogPost']['created']), count($post['Comment']));
		?>
		<?php
			//~ echo $this->Html->image(DS . 'files' . DS . 'Portraits' . DS . $post['User']['Portrait'][0]['filename']);
			//~ echo join('<br>', array(
				//~ $post['User']['name'],
				//~ $this->TimeL8n->niceShort($post['BlogPost']['created']),
				//~ __('%u comments', count($post['Comment']))
			//~ ));
		?>
	</p>
</div>

