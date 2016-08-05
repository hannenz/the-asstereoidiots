<h1><?php echo __('Music'); ?></h1>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<div id="player-holder"></div>

<script type="text/javascript">
	var options = {
	};
	options.firstColor = "ffffff";
	options.secondColor = "A52A2A";
	options.backColor = "000000";
	options.playlistXmlPath = $('#base').html() + 'players/' + "playlist.xml";
	
	var params = {};
	params.allowScriptAccess = "always";
		
	swfobject.embedSWF($('#base').html() + 'players/' + "OriginalMusicPlayerPlaylist.swf", "player-holder", "400", "200", "9.0.0",false, options, params, {});
</script>


<p><?php echo __('Visit The Asstereoidiots at'); ?> <?php echo $this->Html->link('jamendo', 'http://www.jamendo.com/de/artist/The_Asstereoidiots'); ?> <?php echo __('for more music and album download'); ?></p>

