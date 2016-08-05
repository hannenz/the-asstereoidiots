<?php
	App::uses('AppController', 'Controller');
	class ShowsController extends AppController {
		var $name = 'Shows';

		var $helpers = array('Html', 'Form', 'Text', 'Uploader.UploaderForm');

		var $paginate = array(
			'limit' => 5,
			'order' => array ('showtime' => 'desc'),
			'conditions' => array('showtime < NOW()'),
			'recursive' => 1
		);

		function beforeFilter(){
			parent::beforeFilter();
			$this->Show->recursive = 1;
		}

		function index($year = null){
			if ($year === null){
				$year = date('Y');
			}

			$contain = array(
				'Location' => array(
					'fields' => array('Location.name', 'Location.city', 'Location.zip', 'Location.country')
				),
				'Band' => array(
					'fields' => array('Band.name')
				),
				'Comment' => array(
					'fields' => array('Comment.created', 'Comment.name', 'Comment.body')
				),
				'Bill'
			);

			$upcomingShows = $this->Show->find('all', array(
				'conditions' => 'Show.showtime > NOW()',
				'fields' => array('Show.showtime', 'Show.comment', 'Show.slug'),
				'contain' => $contain
			));

			$accomplishedShows = $this->Show->find('all', array(
				'conditions' => array("Show.showtime BETWEEN '$year-01-01' AND '$year-12-31'", "Show.showtime < NOW()"),
				'fields' => array('Show.showtime', 'Show.comment', 'Show.slug'),
				'contain' => $contain
			));



			$current = ($year != null) ? $year : date('Y');
			$years = array();
			for ($year = date('Y'); $year > 2002; $year--){
				$years[] = ($year == $current)
					? sprintf('<strong>%s</strong>', $year)
					: sprintf('<a href="/shows/index/%s">%s</a>', $year, $year)
				;
			}
			$yearpager = sprintf('<div class="yearpager">%s</div>', join(' | ', $years));

			$this->set(compact(array('upcomingShows', 'accomplishedShows', 'yearpager')));

		}

		function admin_index(){
			$this->paginate = array(
				'order' => array('Show.showtime' => 'DESC'),
				'limit' => 10
			);
			$this->set('shows', $this->paginate('Show'));
		}

		function admin_view($id){
			$show = $this->Show->find('first', array(
				'conditions' => array('Show.id' => $id),
				'contain' => array(
					'Location' => array(
						'fields' => array(
							'name',
							'address1',
							'address2',
							'city',
							'zip',
							'country',
							'url',
							'id'
						)
					),
					'Band',
					'User' => array(
						'fields' => array('User.id', 'User.name')
					),
					'Setlist' => array(
						'Songlist' => array(
							'fields' => array('Songlist.pos', 'Songlist.id'),
							'Song' => array('fields' => array('Song.title', 'Song.id'))
						)
					),
					'Comment',
					'Album' => array(
						'Pic' => array('fields' => array('Pic.filename'))
					)
				)
			));
			$this->set('show', $show);
		}


		function admin_stats(){
			$current_year = date('Y');
			for ($year = $current_year; $year > 2002; $year--){
				$shows = $this->Show->getByYear($year);
				$n[$year] = count($shows);
			}
			$this->set('n', $n);
		}


		function admin_add(){
			if (!empty($this->request->data)){
				$showtimeTime = trim($this->request->data['Show']['showtimeTime']);
				unset($this->request->data['Show']['showtimeTime']);

			    if( !(bool)preg_match('/^(?:2[0-4]|[01][0-9]):[0-5][0-9]$/', trim($showtimeTime)) ) {
					$showtimeTime = '22:00';
			    }

				$this->request->data['Show']['showtime'] .= ' ' . $showtimeTime;

				unset($this->request->data['Show']['band_query']);
				unset($this->request->data['Show']['location_query']);

				parse_str($this->request->data['Show']['band_ids'], $bands);
				if (isset($bands['bands'])){
					$this->request->data['Band']['Band'] = $bands['bands'];
				}
				unset($this->request->data['Show']['band_ids']);
				unset($this->request->data['Show']['bill']);

				if (isset($image_path)){
					$this->request->data['Show']['bill'] = $image_path;
				}

				if ($this->Show->save($this->request->data)){
					$this->Session->setFlash('Show has been saved', 'flash_success');
					$this->admin_newsletter();
					$this->redirect('/admin/shows/index');
				}
				else {
					$this->Session->setFlash(__('Failed to save show'), 'flash_warning');
				}
			}
			else {
				$setlists = $this->Show->Setlist->find('list');
				$setlists[0] = __('No setlist');
				ksort($setlists);
				$this->set('setlists', $setlists);
			}
		}

		function admin_edit($id = null){
			$this->Show->id = $id;
			if (empty($this->request->data)){
				$this->request->data = $this->Show->read();
				$this->set('locations', $this->Show->Location->find('list', array('fields' => array('id', 'name'))));
				$this->set('bands', $this->Show->Band->find('list', array('fields' => array('id', 'name'))));
				$setlists = $this->Show->Setlist->find('list');
				$setlists[0] = __('No setlist');
				ksort($setlists);
				$this->set('setlists', $setlists);
			}
			else{
				unset($this->request->data['Show']['band_query']);
				unset($this->request->data['Show']['location_query']);

				parse_str($this->request->data['Show']['band_ids'], $bands);
				if (isset($bands['bands'])){
					$this->request->data['Band']['Band'] = $bands['bands'];
				}
				unset($this->request->data['Show']['band_ids']);

				$this->request->data['Show']['showtime'] .= ' ' . $this->request->data['Show']['showtimeTime'];

				if ($this->Show->save($this->request->data)){
					$this->Session->setFlash('Show has been saved', 'flash_success');
					$this->admin_newsletter();
					$this->redirect('/admin/shows/index');
				}
				else {
					$this->Session->setFlash(__('Failed to save show'), 'flash_warning');
				}
			}
		}

		function admin_newsletter(){
			if ($this->request->data['Show']['newsletter']){
				$show = $this->Show->read();

				$table = sprintf('<table><tr><th>Showtime</th><td>%s</td></tr><tr><th>Location</th><td>%s</td></tr></table>',
					strftime('%a, %d.%m.%Y', strtotime($show['Show']['showtime'])),
					$show['Location']['full_name']
				);

				$body =
					sprintf('<p>%s</p>', $this->request->data['Show']['newsletter_body'])
					. $table
					. sprintf('<a href="%s">Mehr Info</a>', 'http://' . $_SERVER['SERVER_NAME'] . DS . 'shows' . DS . 'view' . DS . $show['Show']['id'])
				;

				$this->admin_send_newsletter($this->request->data['Show']['newsletter_subject'], $body, $this->Subscriber->find('list', array('fields' => array('Subscriber.email'))));
			}
		}

		function admin_delete($id){
			$show = $this->Show->findById($id);
			if ($this->Show->delete($id)){
				$this->requestAction('/full_calendar/events/delete2/'.$show['Show']['event_id']);
				$this->Session->setFlash('Show has been deleted', 'flash_success');
				$this->redirect('/admin/shows/index');
			}
			else {
				$this->Session->setFlash('Failed to delete show', 'flash_warning');
			}
		}

		function view($id){

			$show = $this->Show->find('first', array(
				'conditions' => array(
					'OR' => array(
						'Show.slug' => (string)$id,
						'Show.id' => (int)$id
					)
				),
				'fields' => array('Show.id', 'Show.slug', 'Show.showtime', 'Show.comment', 'Show.created', 'Show.setlist_public'),
				'contain' => array(
					'Location' => array(
						'fields' => array('Location.name', 'Location.city', 'Location.address1', 'Location.address2', 'Location.url', 'Location.zip', 'Location.country')
					),
					'Band' => array(
						//~ 'fields' => array('Band.name')
					),
					'Album' => array(
						'fields' => array('Album.name', 'Album.id'),
						'Show' => array(
							'Location'
						),
						'Picture'
					),
					'Setlist',
					'Comment',
					'User' => array(
						'fields' => array('User.name')
					),
					'Bill'
				)
			));
			$this->set('show', $show);

			setlocale(LC_ALL, 'de_DE.UTF-8');
			$this->set(array(
				'og_image' => Router::url('/', true) . $show['Bill'][0]['files']['thumb'],
				'og_title' => sprintf('THE ASSTEREOIDIOTS Live: %s at %s in %s', strftime('%d %B %Y', strtotime($show['Show']['showtime'])), $show['Location']['name'], $show['Location']['city']),
				'og_url' => Router::url($this->here, true),
				'og_description' => 'Live & Laut!',
				'og_type' => 'article'
			));
		}

		function admin_dummy () {
			$shows = $this->Show->find('all');
			foreach ($shows as $show) {
				$this->Show->save($show);
			}
			$this->Session->setFlash(__('%u shows have been updated', count($shows)));
			$this->redirect(array('action' => 'index','admin' => true));
		}	
	}
?>
