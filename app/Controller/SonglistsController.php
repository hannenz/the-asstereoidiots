<?php
class SonglistsController extends AppController {
	var $name = 'Songlists';
	var $uses = array('Songlist');

	function admin_add(){
		if (!empty($this->request->data)){
			$this->request->data[$this->request->data['Songlist']['Song']]['id'] = $this->request->data['Songlist']['foreign_key'];

			if ($this->Songlist->saveAll($this->request->data)){
				$this->Session->setFlash(__('Songlist has been saved'), 'flash_success');
				$this->redirect($this->referer());
			}
			else {
				$this->Session->setFlash(__('Songlist could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->set('songs', $this->Songlist->Song->find('list'));
		}
	}


	function admin_edit($foreign_key = null){
		if (empty($this->request->data)){
			$this->Songlist->recursive = 2;
			$setlist = $this->Songlist->find('all', array(
				'conditions' => array(
					'Songlist.foreign_key' => $foreign_key
				)
			));
			$this->set('setlist', $setlist);

			$song_ids = array();
			foreach ($setlist as $song){
				$song_ids[] = $song['Song']['id'];
			}
			
			$songs = $this->Songlist->Song->find('all', array(
				'conditions' => array(
					'NOT' => array(
						'Song.id' => $song_ids
					)

				)
			));
			$this->set('songs', $songs);

			$this->request->data['Songlist']['foreign_key'] = $foreign_key;
			$this->request->data['Setlist'] = $this->Songlist->Setlist->read(null, $foreign_key);
			$this->set('referer', $this->referer());
		}
		if ($foreign_key == null){
			$foreign_key = $_POST['foreign_key'];
			parse_str($_POST['songs'], $songs);

			$this->Songlist->recursive = -1;
			$songlist = $this->Songlist->find('all', array(
				'conditions' => array(
					'Songlist.foreign_key' => $foreign_key
				)
			));
			foreach ($songlist as $sl){
				echo "deleting songlist#".$sl['Songlist']['id']."<br>";
				$this->Songlist->delete($sl['Songlist']['id']);
			}

			foreach ($songs['all_songs'] as $pos => $song_id){
				$sl = array();
				$sl['Songlist']['id'] = false;
				$sl['Songlist']['pos'] = $pos + 1;
				$sl['Songlist']['song_id'] = $song_id;
				$sl['Songlist']['foreign_key'] = $foreign_key;
				$this->Songlist->save($sl);
			}
		}
	}
}
?>
