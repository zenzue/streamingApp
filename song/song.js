$(document).ready(function () {
	$('#read-song').hide();

	showSong();

	$('#create-song').click(function () {
		$('#page-content').load('create-song-form.php');
		$('#read-song').show();
		$('#create-song').hide();
		$('#show-brk-ls').hide();
	});

	$('#read-song').click(function () {
		showSong();
	});

	$(document).on('submit', '#create-song-form', function (e) {
		e.preventDefault();

		$.ajax({
			url: "create-song.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function () {
				waitingDialog.show('Please wait! Process is running');
				},
			success: function(data)
		    {
		    	if (data === 'failed') {
		    		waitingDialog.hide();
		    		swal("Error", "Unable to create the new song", "error");
		    		showSong();
		    	} else {
		    		waitingDialog.hide();	
		    		swal("Saved", "Successfully create the new song", "success");
		    		showSong();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 
		});

	});

	$(document).on('click', '#add-playlist', function () {

		var song_id = $(this).closest('td').find('.song-id').text();
		window.location.href = "../playlist/playlist.php?song_id=" + song_id;
		
		// $('#page-content').load('../playlist/playlist.php?song_id=' + song_id);
		// $('#create-song').hide();

	});

	$(document).on('click', '#delete-song', function () {
		var song_id = $(this).closest('td').find('.song-id').text();
		swal({
            title: 'Are you sure delete this song?',
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
              $.post('delete-song.php', { song_id: song_id }).done(function (data) {
              	
              	if (data.status === 'success') {
              		swal(
              		  'Deleted!',
              		  'Your file has been deleted.',
              		  'success'
              		);
              		showSong();
              	} else {
              		swal(
              		  'Error!',
              		  'Unable to delete the promotion.',
              		  'error'
              		);
              		showSong();
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

	$(document).on('click', '#edit-song', function () {
		var song_id = $(this).closest('td').find('.song-id').text();
		$('#page-content').load('update-song-form.php?song_id=' + song_id);
		$('#create-song').hide();
		$('#show-brk-ls').hide();
		$('#read-song').show();
	});

	$(document).on('submit', '#update-song-form', function (e) {
		e.preventDefault();
		// $.post('update-promotion.php', $(this).serialize()).done(function (data) {
		
			$.ajax({
			url: "update-song.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function () {
				waitingDialog.show('Please wait! Process is running');
				},
			success: function(data)
		    {
		    	if (data === 'failed') {
		    		waitingDialog.hide();
		    		swal("Error", "Unable to create the new album", "error");
		    		showSong();
		    	} else {
		    		waitingDialog.hide();	    		
		    		swal("Saved", "Successfully create the new promotion", "success");
		    		showSong();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 
		});
	});

	$(document).on('click', '#show-brk-ls', function () {
		$('#show-brk-ls').hide();
		$('#create-song').hide();
		$('#read-song').show();
		$('#page-content').load('broken-list.php');
	});

	function showSong() {
		$('#page-content').load('read-song.php');	
		$('#read-song').hide();
		$('#create-song').show();	
		$('#show-brk-ls').show();
	}

});