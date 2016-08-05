<?php
	class BlogPostsController extends AppController {
		var $name = 'BlogPosts';
		var $helpers = array('Html', 'Form', 'Text', 'Time');
		//~ var $components = array('RequestHandler');
		var $paginate = array(
			'limit' => 5,
			'order' => array('BlogPost.created' => 'desc'),
			'contain' => array(
				'Comment' => array(
					'fields' => array('Comment.name', 'Comment.body')
				),
				'User' => array(
					'fields' => array('User.face', 'User.name'),
					'Portrait'
				)
			),
			'fields' => array(
				'BlogPost.subject', 'BlogPost.body', 'BlogPost.created'
			)
		);
		var $uses = array('BlogPost', 'Show', 'Subscriber');




		function beforeFilter(){
			parent::beforeFilter();
			$this->BlogPost->recursive = -1;
			$this->BlogPost->contain(array(
				'Comment' => array(
					'fields' => array('Comment.name', 'Comment.body')
				),
				'User' => array(
					'fields' => array('User.face', 'User.name', 'User.id'),
					'Portrait'
				)
			));
			$this->Auth->allow('index', 'news');

		}

		function index(){
			if ($this->RequestHandler->isRss()){
				$this->set('posts', $this->BlogPost->find('all', array('limit' => 3, 'order' => 'BlogPost.created DESC')));
			}
			else{
				$this->paginate = array(
					'limit' => 5,
					'contain' => array(
						'Comment',
						'User' => array(
							'Portrait'
						)
					)
				);
				$this->set('posts', $this->paginate('BlogPost'));
			}
		}

		function view($id){

			$post = $this->BlogPost->findBySlug($id);
			if (empty($post)) {
				$post = $this->BlogPost->findById($id);
			}
			if (empty($post)) {
				$this->Session->setFlash (__('Sorry but this article is not to be available'));
			}
			$referer = $this->referer(array('action' => 'index'), true);
			$this->set(compact(array('post', 'referer')));


			// Extract the first image inside the post's body.. -- if any
			$doc = new DOMDocument();
			$html = '<!doctype html><html><body>'.$post['BlogPost']['body'].'</body></html>';

			if ($doc->loadHTML($html)) {
				$imgTags = $doc->getElementsByTagName('img');
				if ($imgTags->length > 0) {
					foreach($imgTags as $tag) {
						$this->set('og_image', Router::url('/', true) . $tag->getAttribute('src'));
						break;
					}
				}
			}
			$this->set(array(
				'og_type' => 'article',
				'og_title' => $post['BlogPost']['subject'],
				'og_url' => Router::url($this->here, true),
				'og_description' => strip_tags(String::truncate($post['BlogPost']['body']))
			));
		}

		function news(){
			if ($this->RequestHandler->isRss()){
				$this->BlogPost->recursive = 0;
				$this->Show->recursive = 1;
				$shows = $this->Show->getUpcoming();
				$posts = $this->BlogPost->find('all', array('limit' => 3, 'order' => array('BlogPost.created DESC')));
				$this->set('posts', $posts);
				$this->set('upcomingShows', $shows);
			}
		}

		function admin_index(){
			$this->set('posts', $this->paginate('BlogPost'));
		}

		function admin_view($id){
			$item = $this->BlogPost->read(null, $id);
			$this->set('item', $item['BlogPost']);
			$this->render('/elements/admin_view');
		}

		function admin_add(){
			Configure::write('debug', 2);
			if (!empty($this->request->data)){
				if (($im = $this->upload_image()) !== false){
					$this->request->data['BlogPost']['image'] = $im;
				}
				unset($this->request->data['BlogPost']['upload']);
				if ($this->BlogPost->save($this->request->data)){
					$this->Session->setFlash(__("Post has been saved!"),  'flash_success');
					if ($this->request->data['BlogPost']['newsletter']){
						$this->admin_send_newsletter($this->request->data['BlogPost']['subject'], $this->request->data['BlogPost']['body']);
					}
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash(__('Failed to save the post'), 'flash_warning');
				}
			}

		}

		function upload_image(){
			if (!empty($this->request->data['BlogPost']['upload'])){
				return $this->Image->upload($this->request->data['BlogPost']['upload'], array(
					'blog' => array(
						'ctype' => 'resize',
						'width' => 600,
						'height' => 600,
						'quality' => 90
					)
				));
			}
			return (false);
		}

		function admin_edit($id = null){
			$p = $this->BlogPost->find('first',
				array(
					'conditions' => array('BlogPost.id' => $id),
					'fields' => array('User.id')
					)
				);

				$this->BlogPost->id = $id;
				if (empty($this->request->data)){
					$this->request->data = $this->BlogPost->read();
				}
				else{
					if ($this->BlogPost->save($this->request->data)){
						$this->Session->setFlash(__('The post has been saved'), 'flash_success');
						$this->redirect('/blog_posts/view/'.$id);
					}
					else {
						$this->Session->setFlash(__('Failed to save the post'), 'flash_warning');
					}
				}
		}

		function admin_delete($id){
			$p = $this->BlogPost->find('first',
				array(
					'conditions' => array('BlogPost.id' => $id),
					'fields' => array('User.id')
				)
			);
			if ($this->BlogPost->delete($id)){
				$this->Session->setFlash(__('Post has been deleted successfully'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('Failed to delete this post'), 'flash_warning');
			}
		}

	}
?>
