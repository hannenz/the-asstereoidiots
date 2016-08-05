<?php
class TracklistsController extends AppController {
	var $name = 'Tracklists';
	var $uses = array('Tracklist');

	function admin_add(){
		if (!empty($this->request->data)){
			$this->request->data[$this->request->data['Tracklist']['model']]['id'] = $this->request->data['Tracklist']['foreign_key'];

			if ($this->Tracklist->saveAll($this->request->data)){
				$this->Session->setFlash(__('Tracklist has been saved'), 'flash_success');
				$this->redirect($this->referer());
			}
			else {
				$this->Session->setFlash(__('Tracklist could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->set('songs', $this->Tracklist->Song->find('list'));
			$this->set('releases', $this->Tracklist->Release->find('list'));
		}
	}


	function admin_edit($model = null, $foreign_key = null){
		if (empty($this->request->data)){
			$this->Tracklist->recursive = 2;
			$tracklist = $this->Tracklist->find('all', array(
				'conditions' => array(
					'Tracklist.foreign_key' => $foreign_key,
					'Tracklist.model' => $model
				)
			));
			$this->set('tracklist', $tracklist);

			$track_ids = array();
			foreach ($tracklist as $track){
				$track_ids[] = $track['Track']['id'];
			}

			$this->Tracklist->Track->recursive = 1;
			$tracks = $this->Tracklist->Track->find('all', array(
				'conditions' => array(
					'NOT' => array(
						'Track.id' => $track_ids
					)

				)
			));
			$this->set('tracks', $tracks);

			$this->request->data['Tracklist']['foreign_key'] = $foreign_key;
			$this->request->data['Tracklist']['model'] = $model;
			$this->set('referer', $this->referer());
			switch ($model){
				case 'Release':
					$release = $this->Tracklist->Release->read(null, $foreign_key);
					$this->set('title', $release['Release']['title']);
					break;
				case 'Setlist':
					$this->set('title', __('Setlist'));
					break;
				case 'Playlist':
					$this->set('title', __('Playlist'));
					break;
			}
		}
		if ($model == null && $foreign_key == null){
			$model = $_POST['model'];
			$foreign_key = $_POST['foreign_key'];
			parse_str($_POST['tracks'], $tracks);

			$this->Tracklist->recursive = -1;
			$tracklist = $this->Tracklist->find('all', array(
				'conditions' => array(
					'Tracklist.model' => $model,
					'Tracklist.foreign_key' => $foreign_key
				)
			));
			foreach ($tracklist as $tl){
				echo "deleting tracklist#".$tl['Tracklist']['id']."<br>";
				$this->Tracklist->delete($tl['Tracklist']['id']);
			}

			foreach ($tracks['all_tracks'] as $pos => $track_id){
				$tl = array();
				$tl['Tracklist']['id'] = false;
				$tl['Tracklist']['pos'] = $pos + 1;
				$tl['Tracklist']['track_id'] = $track_id;
				$tl['Tracklist']['foreign_key'] = $foreign_key;
				$tl['Tracklist']['model'] = $model;
				$this->Tracklist->save($tl);
			}
		}
	}

/*
	function admin_edit($model = null, $foreign_key = null){
		if (empty($this->request->data)){
			$this->Tracklist->recursive = 2;
			$tracklist = $this->Tracklist->find('all', array(
				'conditions' => array(
					'Tracklist.model' => $model,
					'Tracklist.foreign_key' => $foreign_key
				)
			));
			$this->set('tracklist', $tracklist);

			$track_ids = array();
			foreach ($tracklist as $track){
				$track_ids[] = $track['Track']['id'];
			}

			$this->set('tracks', $this->Tracklist->Track->find('all', array(
				'conditions' => array(
					'NOT' => array(
						'Track.id' => $track_ids
					)

				)
			)));

			$this->set('all_tracks', $this->Tracklist->Track->find('all'));

			$this->request->data['Tracklist']['model'] = $model;
			$this->request->data['Tracklist']['foreign_key'] = $foreign_key;
			$this->set('referer', $this->referer());

			switch ($model){
				case 'Release':
					$release = $this->Tracklist->Release->read(null, $foreign_key);
					$this->set('title', $release['Release']['title']);
					break;
				case 'Setlist':
					$this->set('title', __('Setlist'));
					break;
				case 'Playlist':
					$this->set('title', __('Playlist'));
					break;
			}
		}
		if ($model == null && $foreign_key == null){
			$model = $_POST['model'];
			$foreign_key = $_POST['foreign_key'];
			parse_str($_POST['songs'], $songs);

			$this->Tracklist->recursive = -1;
			$tracklist = $this->Tracklist->find('all', array(
				'conditions' => array(
					'Tracklist.model' => $model,
					'Tracklist.foreign_key' => $foreign_key
				)
			));
			foreach ($tracklist as $tl){
				echo "deleting tracklist#".$tl['Tracklist']['id']."<br>";
				$this->Tracklist->delete($tl['Tracklist']['id']);
			}

			foreach ($songs['songs'] as $pos => $song_id){
				$tl = array();
				$tl['Tracklist']['id'] = false;
				$tl['Tracklist']['pos'] = $pos + 1;
				$tl['Tracklist']['song_id'] = $song_id;
				$tl['Tracklist']['foreign_key'] = $foreign_key;
				$tl['Tracklist']['model'] = $model;
				$this->Tracklist->save($tl);
			}
		}
	}
*/
}
?>
