$(document).ready(function () {
	$('#read-playlist').hide();

	// var song_id =  document.getElementById(song_id);
	var song_id = $('#song_id').val();

	showPlaylist();

	
	$(document).on('click', '#create-playlist', function () {
		$('#page-content').load('create-playlist-title.php?song_id=' + song_id);
	});

	$(document).on('submit', '#create-playlist-title-form', function (e) {
		e.preventDefault();
		
			$.ajax({
	        	url: "create-playlist.php",
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
			    		showPlaylist();
			    	} else if (data.status === 'failed') {
			    		swal("Error", "Unable to create the new playlist", "error");
			    		showPlaylist();
			    	}
			    },
			  	error: function(e) 
		    	{
					$("#err").html(e).fadeIn();
		    	} 	        
		   });

	});

	$(document).on('click', '#add-play-song', function () {

		var playlist_id = $(this).closest('td').find('.playlist-id').text();
		var playlist_name = $(this).closest('tr').find('.playlist-name').text();
		
		$.post('add_playlist_song.php', {playlist_id : playlist_id, song_id : song_id}).done(function (data) {
			
			if (data.status === 'data_full') {
				swal("Info", "This playlist if full of songs.Please create new playlist title", "success");
				showMainPlaylistDetail(playlist_id, playlist_name);				
			} else if (data.status === 'success') {
				swal("Saved", "Successfully create the new playlist", "success");
				showMainPlaylistDetail(playlist_id, playlist_name);					
			} else {
				swal("Error", "Unable to create the new playlist", "error");
				showMainPlaylistDetail(playlist_id, playlist_name);	
			}
		});
	});


	$(document).on('click', '#show-play-song', function () {
		var playlist_id = $(this).closest('td').find('.playlist-id').text();
		var playlist_name = $(this).closest('tr').find('.playlist-name').text();
		$('#page-content').load('read-main-playlist-detail.php', { playlist_id : playlist_id, playlist_name : playlist_name});
	});

	$(document).on('click', '#delete-playlist', function () {
		var playlist_det_id = $(this).closest('td').find('.playlist-det-id').text();		
		var playlist_id = $('#playlist_id').val();
		var playlist_name = $('#playlist_name').val();

		$.post('delete-playlist.php', {playlist_det_id : playlist_det_id }, function (data) {
			if (data.status === 'success') {
				swal("Saved", "Successfully remove the playlist", "success");
				showMainPlaylistDetail(playlist_id, playlist_name);			
			} else {
				swal("Error", "Unable to remove the playlist", "error");
				showMainPlaylistDetail(playlist_id, playlist_name);
			}
		});
	});

	function showMainPlaylistDetail(playlist_id, playlist_name) {
		$('#page-content').load('read-main-playlist-detail.php', { playlist_id : playlist_id, playlist_name : playlist_name});
	}

	function showPlaylist() {
		$('#page-content').load('read-playlist.php?song_id=' + song_id);
	}




});