<?php
class PlaylistsController extends AppController {
	var $name = 'Playlists';
	var $components = array('RequestHandler');

	function beforeFilter(){
		parent::beforeFilter();
		$this->Playlist->recursive = 2;
	}

	function view($id){
		$this->set('playlist', $this->Playlist->read(null, $id));
	}

	function admin_edit($id){
		$this->request->data = $this->Playlist->read(null, $id);
		$this->Playlist->Tracklist->recursive = 2;
		$tracklist = $this->Playlist->Tracklist->find('all', array(
			'conditions' => array(
				'Tracklist.model' => 'Playlist',
				'Tracklist.foreign_key' => $id
			)
		));
		$this->set('tracklist', $tracklist);
	}

	function admin_update($playlist_id){
		$playlist = $this->Playlist->read(null, $playlist_id);
		$tracks = $_POST['tracks'];
		foreach ($tracks as $pos => $id){
			$track = $this->Playlist->Track->read(null, $id);
			$track['Track']['playlist_id'] = $playlist_id;
			$track['Track']['playlist_pos'] = $pos;
			$this->Playlist->Track->save($track);
		}
		$this->admin_build($playlist_id);
		exit(0);
	}

	function admin_remove_track($playlist_id, $track_id){
		$playlist = $this->Playlist->read(null, $playlist_id);
		$this->Playlist->Track->read(null, $track_id);
		$this->Playlist->Track->set('playlist_id', 0);
		$this->Playlist->Track->save();
		$this->admin_build($playlist_id);
		exit(0);
	}

	function admin_build($playlist_id){
		App::import ('Helper', 'Html');
		$html = new HtmlHelper();
		$tracks = $this->Playlist->Track->find('all', array(
			'order' => array('Track.playlist_pos' => 'ASC'),
			'conditions' => array('Track.playlist_id' => $playlist_id)
		));
		$output = '<?xml version="1.0" encoding="utf-8"?>' . "\n\n" . '<playlist>' . "\n";
		foreach ($tracks as $track){
			$output .= "\n\t" . $html->tag('item',
				$html->tag('title', $track['Track']['title']) . "\n\t\t" .
				$html->tag('artist', 'The Asstereoidiots') . "\n\t\t" .
				$html->tag('path', DS . 'files' . DS . $track['Track']['filename']) . "\n\t\t"
			) . "\n\n";
		}
		$output .= "\n</playlist>\n";
		if (!file_put_contents(WWW_ROOT . 'players' . DS . 'playlist.xml', $output)){
			$this->Session->setFlash(__('Building playlist failed'), 'flash_warning');
		}
	}
}
?>
