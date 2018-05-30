<!--h1>The Asstereoidiots</h1-->
<?php #echo $this->Html->image('band.jpg', array('id' => 'theband')); ?>

<h1>The Asstereoidiots</h1>
<p>das sind vier sympathische Motherfucker mit der Lizenz zum Arschrocken. Rock, Punk`n`Roll, Maximum Rock`n`Roll Machine, Ass-in-Your-Ugly-Mama's-Face Rock'n'Roll, SuperAssRock. Hier gibts ordentlich was um die Ohren, die Arschidioten sind stets in der Lage die Mundwinkel der Zuh&ouml;rer Richtung Lauschlappen zu man&ouml;vrieren.</p>
<p><strong>Must have seen it... <?=$this->Html->link('live!', '/shows')?></strong></p>

<ul id="bandmembers" class="item-list clearfix">
	<li id="band-preskin">
		<?php #echo $this->Html->tag('div', $this->Html->image('faces/preskin.jpg'), array('class' => 'list-item-image')); ?>
		<div class="list-item-content">
			<h2>Preskin The Kid &middot; Gitarre &amp; Gesang</h2>
			<p class="news-body">H&auml;tte er nicht den Rock'n'Roll durch die wodkagetr&auml;nkte Muttermilch in sich aufgenommen, tja was dann??? &hellip;aber er hat ja:</p>
			<p class="news-meta">Rock'n'Roll is gonna kill him - Rock'n'Roll keeps him alive!</p>
		</div>
	</li>
	<li id="band-joeanus">
		<?php #echo $this->Html->tag('div', $this->Html->image('faces/joeanus.jpg'), array('class' => 'list-item-image')); ?>
		<div class="list-item-content">
			<h2>Joe Anus &middot; Gitarre</h2>
			<p class="news-body">der fabelhafte Gitarren-Jockey. Wer seinem Spiel lauscht, hört, was er hat: Haare auf der Brust und das nicht zu knapp. In diesem Sinne&hellip;</p>
			<p class="news-meta">"SG ass can be...!"</p>
		</div>
	</li>
	<li id="band-senordon" style="background-image:url('/img/earlobrain.jpg')">
		<?php #echo $this->Html->tag('div', $this->Html->image('faces/senordon.jpg'), array('class' => 'list-item-image')); ?>
		<div class="list-item-content">
			<h2>Earl O'Brain &middot; Bass</h2>
			<p class="news-body">Ein ausgenommenes Genie mit Mut zur Lücke. Er hat die Weisheit mit Gabeln gefressen.</p>
			<p class="news-meta">Basst.</p>
		</div>
	</li>
	<li id="band-general">
		<?php #echo $this->Html->tag('div', $this->Html->image('faces/general.jpg'), array('class' => 'list-item-image')); ?>
		<div class="list-item-content" style="top:0;bottom:auto">
			<h2>General Joxe &middot; Schlagzeug</h2>
			<p class="news-body">Der Mann, der Mythos - DIE MASCHINE. Wenn der hauptamtliche Fellvergewaltiger loslegt, kann das nur eins bedeuten:</p>
			<p class="news-meta">Scream for the General!</em> und zwar as loud as U can, kapiert!</p>
		</div>
	</li>
</ul>


<div style="clear:both"></div>

<h2>Infomaterial (Presse &amp; Technik)</h2>
<p><?php echo $this->Html->link('Infopaket', DS . 'files' . DS . 'Presseinfo_The_Asstereoidiots.zip'); ?> zum herunterladen, beinhaltet Pressetext, Fotos, Logo und technical Rider (ZIP-Archiv, ca. 11 MB). </p> 



<script>
$(document).ready(function(){

	return;

	var viewport = $('<div />');
	viewport.css({
		'height' : '700px',
		'width' : '550px',
		'overflow' : 'hidden',
		'position' : 'relative',
		'cursor' : 'pointer'
	});
	$('#bandmembers').wrap(viewport);

	$('#bandmembers').css({
		'height' : '503px',
		'width' : '3000px',
		'position' : 'absolute',
		'left' : 0,
		'top' : 0
	});
	$('#bandmembers li').css({
		'clear' : 'none',
		'float' : 'left',
		'height' : '503px',
		'width' : '550px',
		'margin' : 0,
		'padding' : 0
	});

	var n = 0;

	$('#bandmembers').click(slide);

	function slide (){
		if (n++ >= 3){
			n = 0;
		}

		var newLeft = n * -550;
		$(this).fadeOut(300, function(){
			$(this).css('left', newLeft + 'px').fadeIn(150);
		});
		//$(this).animate({ 'left' : newLeft}, 500);
	}
});
</script>
