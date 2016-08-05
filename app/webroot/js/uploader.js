// uploader.js
//
// Copyright 2011 Johannes Braun <me@hannenz.de>
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
// MA 02110-1301, USA.
//
//

// Detects support for this kind of stuff
//
// name: has_html5_upload_support
// @return boolean
//
function has_html5_upload_support(){
	var input = document.createElement('input');
	input.type = 'file';
	return false;
	return ('multiple' in input && typeof File != "undefined" && typeof (new XMLHttpRequest()).upload != "undefined");
}

function on_sortable_update(e, ui){
	var ul = $(ui.item).parents('ul').first();
	var ctl = ul.siblings('.uploader-list-controls');
	var element = $(ul).parents('div.input.file.uploader').find('input.uploader-element').val();
	ctl.addClass('busy');

	$.post('/uploader/uploads/reorder/' + element, $(this).sortable('serialize'), function(r){
		var newList = $(r);
		ul.replaceWith(newList);
		prepare_list(newList);
		ctl.removeClass('busy');
	});
}

function on_select_clicked(){
	$(this).parents('.input.uploader').find('ul.uploader-list').find('input[type=checkbox]').each(function(i, el){
		if ($(el).attr('checked')){
			$(el).removeAttr('checked');
		}
		else {
			$(el).attr('checked', 'checked');
		}
	});
	return false;
}

function on_delete(){
	var url = $(this).attr('href');
	var ul = $(this).parents('ul.uploader-list');
	var ctl = ul.siblings('.uploader-list-controls');
	var element = $(ul).parents('div.input.file.uploader').find('input.uploader-element').val();
	url += '/';
	url += element;
	ctl.addClass('busy');
	$.get(url, function(r){
		var newList = $(r);
		ul.replaceWith(newList);
		prepare_list(newList);
		ctl.removeClass('busy');
	});
	return false;
}

function prepare_list(list){
	var ul = $(list);
	var listItems = ul.children('li');
	var ctl = ul.parents('.input.file.uploader').find('.uploader-list-controls');

	if (ctl.length > 0){
		ul.find('a.uploader-list-up, a.uploader-list-down').parent('li').remove();
		ul.find('a.uploader-list-delete').click(on_delete);

		if (listItems.length > 1){
			ul.sortable({
				update : on_sortable_update
			});
			listItems.css('cursor', 'move');

			if (ctl.find('a.uploader-list-select-link').length == 0){
				$('<a href="#" class="uploader-list-select-link">Select</a>').appendTo(ctl).click(on_select_clicked);
			}
			ul.find('div.input.checkbox').css('visibility', 'visible');
		}
		else {
			ul.find('div.input.checkbox').css('visibility', 'hidden');
			ctl.find('a.uploader-list-select-link').remove();
		}
	}
}

$(document).ready(function(){

	var ctl = $('<div class="uploader-list-controls" />');
	ctl.insertAfter($('.input.uploader input[type=file]'));

	$('ul.uploader-list').each(function(i, element){
		var ul = $(element);
		prepare_list(ul);
		if (ul.hasClass('uploader-replace')){
			ul.prev('.uploader-list-controls').find('a.uploader-list-select-link').remove();
		}
		var infoLink = $('<a href="#" class="uploader-info-link">info</a>');
		var info = ul.parents('.uploader.input').find('.uploader-info');
		info.hide();
		infoLink.prependTo(ctl).click(function(){
			if (info.is(':visible')){ info.slideUp(); } else { info.slideDown(); }
			return false;
		});
	});



	$('.input.file.uploader').each(function(){
		var container = $(this);

		var a = container.attr('id').split('_');
		var model = a[1];
		var uploadAlias = a[2];
		var foreignKey = a[3];
		var element = container.find('input.uploader-element').val();

		var fileInput = $(this).find('input[type=file]');
		var form = $(this).parents('form').first();

		fileInput.html5_upload({
			url : function(){
				return ('/uploader/uploads/add/'+model+'/'+uploadAlias+'/'+foreignKey+'/'+element);
			},
			autostart : true,
			autoclear : true,
			sendBoundary : window.FormData || $.browser.mozilla,
			fieldName : 'upload',
			onStart : on_start,
			onStartOne : on_start_one,
			onProgress : on_progress,
			onFinishOne : on_finish_one,
			onFinish : on_finish
		});

		function on_start(event, files){
			var queue = $('<ul />');
			queue.addClass('uploader-queue');

			/* Add files to queue */
			$(files).each(function(n, file){
				var li = $('<li />');
				var nr = $('<span class="uploader-queue-nr">'+(n + 1)+'</span>');
				var total = $('<span class="uploader-queue-total">'+files.length+'</span>');
				var name = $('<span class="uploader-queue-filename">' + file.name + '</span>');
				var perc = $('<span class="uploader-queue-perc">0.00%</span>');
				var bar = $('<div class="uploader-queue-progressbar"><div class="uploader-progressbar" style="width:0%"></div></div>');
				li
					.addClass('uploader-queue-item-' + n)
					.addClass('uploader-status-pending')
					.append(nr)
					.append(total)
					.append(name)
					.append(perc)
					.append(bar)
				;
				queue.append(li);
			});
			queue.insertBefore(container.find('.uploader-list'));


			var ctl = container.find('.uploader-list-controls');
			var cancelAllLink = $('<li><a href="#" class="uploader-queue-cancel-all">Cancel all</a></li>');
			cancelAllLink.click(function(){
				fileInput.triggerHandler('html5_upload.cancelAll');
				queue.find('li').addClass('uploader-queue-cancelled');
				on_finish();
				return false;
			}).prependTo(queue);
			ctl.find('a.uploader-select-link').remove();

			return true;
		}

		function on_start_one(event, name, number, total){
			var listItem = container.find('.uploader-queue-item-'+number);

			var cancel = $('<a href="#" class="uploader-queue-cancel-one">Cancel</a>');
			cancel.click(function(){
				console.log('triggering cancel event');
				listItem.addClass('uploader-queue-cancelled');
				fileInput.triggerHandler('html5_upload.cancelOne');
				return false;
			});
			listItem
				.append(cancel)
				.removeClass('uploader-status-pending')
				.addClass('uploader-status-uploading')
			;
			listItem.find('.uploader-progressbar').css('width', '1px');
			return (true);
		}

		function on_progress(event, progress, name, number, total){
			var perc = (progress * 100).toFixed(2) + '%';
			var queueItem = container.find('.uploader-queue-item-' + number);

			queueItem.find('.uploader-queue-perc').html(perc);
			queueItem.find('.uploader-progressbar').css('width', perc);
		}

		function on_finish_one(event, response, name, number, total){
			var queueItem = container.find('.uploader-queue-item-' + number);
			var listItem = $('<li>'+response+'</li>');
			var id = listItem.find('input[type=checkbox]').val();
			listItem.addClass(container.find('.uploader-element').val());
			listItem.attr('id', model+'.'+uploadAlias+'_'+id);

			queueItem.find('.uploader-queue-perc').html('100.00%');
			queueItem.find('.uploader-progressbar').css('width', '100%');
			queueItem.find('.uploader-queue-cancel-one').remove();

			queueItem
				.removeClass('uploader-status-uploading')
				.addClass('uploader-status-finished')
				.delay(500)
				.fadeOut(function(){
					$(this).remove();
				})
			;

			var list = container.find('.uploader-list');
			if (list.hasClass('uploader-replace') && !$(response).hasClass('error') && list.children().length > 0){
				list.find('li:first').replaceWith(listItem);
			}
			else {
				list.append(listItem);
			}

			if ($(response).hasClass('error')){
				listItem.css('cursor', 'pointer').click(function(){
					$(this).remove();
				});
			}
			return true;
		}

		function on_finish(){
			container.find('.uploader-queue').delay(1000).fadeOut(function(){
				$(this).remove()
			});
			var list = container.find('ul.uploader-list');
			var ctl = container.find('.uploader-list-controls');
			container.find('.uploader-queue-cancel-all').remove();
			prepare_list(list);
		}
	});
});
