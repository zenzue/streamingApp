$(document).ready(function () {

	showMainPlaylist()

	$(document).on('click', '#create-playlist', function () {
		$('#page-content').load('create-main-playlist-title.php');
	});

	$(document).on('submit', '#create-main-playlist-title-form', function (e) {

		e.preventDefault();
		
			$.ajax({
	        	url: "create-main-playlist.php",
				type: "POST",
				data:  new FormData(this),
				dataType: "json",
				contentType: false,
	    	    cache: false,
				processData:false,
				success: function(data)
			    {
			    	if (data.status === 'success') {

			    		swal("Saved", "Successfully create the new playlist", "success");
			    		showMainPlaylist();
			    	} else if (data.status === 'failed') {
			    		swal("Error", "Unable to create the new playlist", "error");
			    		showMainPlaylist();
			    	}
			    },
			  	error: function(e) 
		    	{
					$("#err").html(e).fadeIn();
		    	} 	        
		   });
	});

	$(document).on('click', '#edit-main-play-song', function () {
		var playlist_id = $(this).closest('td').find('.main-playlist-id').text();
		$("#page-content").load("update-main-playlist-title.php?playlist_id=" + playlist_id);
	});

	$(document).on('submit', '#update-main-playlist-title-form', function (e) {
		
		e.preventDefault();

		$.ajax({

        	url: "update-main-playlist.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
		    	if (data.status === 'success') {
		    		swal("Saved", "Successfully update the new playlist", "success");
		    		showMainPlaylist();
		    	} else if (data.status === 'failed') {
		    		swal("Error", "Unable to update the new playlist", "error");
		    		showMainPlaylist();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 

		});

	});


	$(document).on('click', '#show-main-play-song', function () {

		var playlist_id = $(this).closest('td').find('.main-playlist-id').text();
		var playlist_name = $(this).closest('tr').find('.main-playlist-name').text();

		$('#page-content').load('read-main-playlist-detail.php', { playlist_id : playlist_id, playlist_name : playlist_name});
	});

	$(document).on('click', '#delete-playlist', function () {
		var song_id = $(this).closest('td').find('.song-id').text();
		$.post('delete-playlist.php', {song_id : song_id }, function (data) {
			if (data.status === 'success') {
				swal("Saved", "Successfully remove the playlist", "success");
				showMainPlaylist();				
			} else {
				swal("Error", "Unable to remove the playlist", "error");
				showMainPlaylist();
			}
		});
	});

	$(document).on('click', '#delete-main-play-song', function () {
		var playlist_id = $(this).closest('td').find('.main-playlist-id').text();
		
				swal({
		            title: 'Are you sure delete this playlist?',
		            text: 'You will not be able to recover this imaginary file!',
		            type: 'warning',
		            showCancelButton: true,
		            confirmButtonColor: '#3085d6',
		            cancelButtonColor: '#d33',
		            confirmButtonText: 'Yes!',
		            cancelButtonText: 'No!',
		            closeOnConfirm: false,
		            closeOnCancel: false
		        },
		        function(isConfirm) {
		            if (isConfirm) {

		            	$.post('delete-main-playlist.php', { playlist_id : playlist_id }).done(function (data) {
	            		  	if (data.status === 'success') {
				              		swal(
				              		  'Deleted!',
				              		  'Your file has been deleted.',
				              		  'success'
				              		);
				              		showMainPlaylist();
				              	} else {
				              		swal(
				              		  'Error!',
				              		  'Unable to delete the promotion.',
				              		  'error'
				              		);
				              		showMainPlaylist();
				              	}
		            	});
		            } else {
		              swal(
		                'Cancelled',
		                'Your imaginary file is safe :)',
		                'error'
		              );
		            }
		        });


	});

	function showMainPlaylist () {
		$('#page-content').load('read-main-playlist.php');
		$('#read-playlist').hide();
	}


});