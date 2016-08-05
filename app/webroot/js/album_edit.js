
function make_sortable(list, album_id){
	Sortable.create(list,
		{
			overlap : 'horizontal',
			constraint : '',
			ghosting : false,
			scroll : window,
			onUpdate : function () {
				new Ajax.Request('/cakeass/pics/reorder/'+album_id,
					{
						method : 'post',
						parameters : { data : Sortable.serialize(list) },
						onSuccess : function(transport) {},
						onFailure : function(){ alert('Something went wrong while reordering! Please reload this page and try again.') }
					}
				)
			}
		}
	) ;
}


function init_edit(album_id){

	$$('.controlPanel').each(
		function(e){
			e.observe('mouseover',
				function(ev){
					ev.element().setOpacity(1.0);
				}
			);
			e.observe('mouseleave',
				function(ev){
					$$('.controlPanel').each( function(e){e.setOpacity(0)});
				}
			);
		}
	);

	make_sortable('editPicsList', album_id);
}	
