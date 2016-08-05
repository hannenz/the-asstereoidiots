      <object id="flash_fallback_1" class="vjs-flash-fallback" width="<?php echo $width; ?>" height="<?php echo $height; ?>" type="application/x-shockwave-flash" 
        data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
        <param name="allowfullscreen" value="true" />
        <param name="flashvars" 
          value='config={"playlist":["<?php echo DS . 'img' . DS . 'video_posters' . DS . $video['Video']['poster']; ?>", {"url": "http://<?php echo $_SERVER['SERVER_NAME'] . DS .'files' . DS . $video['Video']['filename']; ?>","autoPlay":false,"autoBuffering":true}]}' />
        <!-- Image Fallback. Typically the same as the poster image. -->
        <img src="<?php echo DS . 'img' . DS . 'video_posters' . DS . $video['Video']['poster']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="Poster Image" 
          title="<?php echo __('No video playback capabilities.');?>" />
      </object>

