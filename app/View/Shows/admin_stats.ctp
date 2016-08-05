<h1><?php echo __('Show Statistics'); ?></h1>

<p><?php echo __('Click on the graph bars to display the Shows for a specific year'); ?></p>

<table>
<?php $total = 0; ?>
<?php foreach ($n as $year => $count): ?>
	<tr><th class="stats-year"><?php echo $year; ?></th><td><?php echo $this->Html->link($this->Html->tag('span', $count, array('class' => 'stats-count')).' Shows', '/shows/index/'.$year, array('escape' => false))?></td></tr>
	<?php $total += $count; ?>
<?php endforeach ?>
</table>

<div id="stats-container" style="position:relative">
	<div id="tooltip" style="box-shadow:2px 2px 2px #000; padding:4px 8px; position:absolute; background:#F9DFA3"></div>
	<canvas id="canvas" width="554" height="320"></canvas>
</div>
<?php echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));?>

<h1 id="output-heading"></h1>
<p><?php echo sprintf("%s %s", $this->Html->tag('span', $total, array('id' => 'output-text')), __('shows total')); ?></p>
<div id="output"></div>

<script>

function randomColor(color){
	if (color[0] != '#'  || (color.length != 4 && color.length != 7)){
		return ('#888888');
	}
	var base = [];
	if (color.length == 7){
		base[0] = parseInt(color.substr(1, 2), 16);
		base[1] = parseInt(color.substr(3, 2), 16);
		base[2] = parseInt(color.substr(5, 2), 16);
	}
	else{
		base[0] = parseInt(color[1], 16);
		base[1] = parseInt(color[2], 16);
		base[2] = parseInt(color[3], 16);
	}
	var random_color = [];
	var str = '#';
	for (var i = 0; i < 3 ; i++){
		random_color[i] = parseInt((Math.floor(Math.random() * 255) + base[i]) / 2);
		var hex = random_color[i].toString(16);
		if (hex.length == 1){
			hex = '0'+hex;
		}
		str += hex;
	}
	return (str);
}

function detect_canvas(){
	return (!!document.createElement('canvas').getContext);
}

$(document).ready(function(){

	if (!detect_canvas()){
		return;
	}

	$('table').hide();
	
	stats = {};
	$('tr').each(function(){
		stats[$(this).find('th.stats-year').html()] = parseInt($(this).find('span.stats-count').html());
	});

	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');

    var max = 0;
    var years = 0;
    $.each(stats, function(i, n){
		if (n > max){
			max = n;
		}
		years++;
	});
	if (max % 2){
		max++;
	}
	var yunit = parseInt(canvas.height / max);
	var xunit = parseInt(canvas.width / years);
	
	context.strokeStyle = '#ccc';
	context.fillStyle = '#888';
	context.lineWidth = 1;
	context.font = '10pt Arial';

	for (var i = 0; i < canvas.height; i += (2 * yunit)){
		context.beginPath();
		context.moveTo(0, canvas.height - i)
		context.lineTo(canvas.width, canvas.height - i);
		context.closePath();
		context.stroke();
		context.fillText(i / yunit, 0, canvas.height - i);
	}


	var n = 0;
	$.each(stats, function(year, count){
		var xoffset = n * xunit;
		var yoffset = count * yunit;
		context.fillStyle = randomColor('#1E90FF');
		context.fillRect(xoffset, canvas.height - yoffset, xunit, yoffset);
		n++;
		context.fillStyle = '#fff';
		context.fillText(year, xoffset, canvas.height - 10, xunit);
	});



	$(canvas).hover(function(){
		$('#tooltip').show();
	});

	$(canvas).mouseout(function(){
		$('#tooltip').hide();
	});

	$(canvas).mousemove(function(e){
		var x = Math.floor((e.pageX - $(canvas).offset().left));
		var y = Math.floor((e.pageY - $(canvas).offset().top));
		var nr = parseInt(x / xunit);
		var year = 0;
		$.each(stats, function(i, n){
			if (--nr < 0){
				year = i;
				return (false);
			}
		});
		$('#tooltip').text(year + ': ' + stats[year] + ' Shows').css({ left : x + 20, top : y - 20});
	});

	$(canvas).click(function(e){
		console.log('canvas.width=' + canvas.width + 'xunit=' + xunit);
		console.log('canvas clicked');
		var x = Math.floor((e.pageX - $(canvas).offset().left));
		var nr = parseInt(x / xunit);

		var year = 0;
		$.each(stats, function(i, n){
			if (--nr < 0){
				year = i;
				return (false);
			}
		});

		$('#output').load('/shows/index/'+year+' #accomplishedShows', function(){
			$('#output-heading').text(year);
			$('#output-text').text($('#output li').length);
		});
	});
});
</script>
