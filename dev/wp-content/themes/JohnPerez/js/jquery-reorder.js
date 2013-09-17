jQuery(document).ready(function() {

	function admin_gallery_reorder(){
		var gallery_List = jQuery('#gallery-reorder-lists');
		
		gallery_List.sortable({
			update: function(event, ui) {
				
				opts = {
					url: ajaxurl,
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
						action: 'gallery_reorder',
						order: gallery_List.sortable('toArray').toString() 
					},
					success: function(response) {
						return;
					},
					error: function(xhr,textStatus,e) {
						alert('There was an error saving the update.');
						return;
					}
				};
				jQuery.ajax(opts);
			}
		});
	}

	admin_gallery_reorder();
	
	function admin_movingimages_reorder(){
		var movingimages_List = jQuery('#movingimages-reorder-lists');
		
		movingimages_List.sortable({
			update: function(event, ui) {
				
				opts = {
					url: ajaxurl,
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
						action: 'movingimages_reorder',
						order: movingimages_List.sortable('toArray').toString() 
					},
					success: function(response) {
						return;
					},
					error: function(xhr,textStatus,e) {
						alert('There was an error saving the update.');
						return;
					}
				};
				jQuery.ajax(opts);
			}
		});
	}

	admin_movingimages_reorder();
});