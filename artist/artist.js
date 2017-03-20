$(document).ready(function () {

	$('#read-artist').hide();


	showArtist();

	$('#create-artist').click(function () {
		$('#page-content').load('create-artist-form.php');
		$('#read-artist').show();
		$('#create-artist').hide();
	});

	$(document).on('submit', '#create-artist-form', function (event) {
		event.preventDefault();
		
		$.ajax({
        	url: "create-artist.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {

		    	if (data.status === 'success') {

		    		swal("Saved", "Successfully create the new artist", "success");
		    		showArtist();
		    	} else if (data.status === 'failed') {
		    		swal("Error", "Unable to create the new artist", "error");
		    		showArtist();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });

	});


	$(document).on('click', '#delete-artist', function () {
		var artist_id = $(this).closest('td').find('.artist-id').text();
		swal({
            title: 'Are you sure delete this artist?',
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
              $.post('delete-artist.php', { artist_id: artist_id }).done(function (data) {
              	
              	if (data.status === 'success') {
              		swal(
              		  'Deleted!',
              		  'Your file has been deleted.',
              		  'success'
              		);
              		showArtist();
              	} else {
              		swal(
              		  'Error!',
              		  'Unable to delete the artist.',
              		  'error'
              		);
              		showArtist();
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

	$(document).on('click', '#edit-artist', function () {
		var artist_id = $(this).closest('td').find('.artist-id').text();
		$('#page-content').load('update-artist-form.php?artist_id=' + artist_id, function () {
			$('#read-artist').show();
			$('#create-artist').hide();
		});
	});

	$(document).on('submit', '#update-artist-form', function (event) {
		event.preventDefault();
		var artist_id = $('#artist_id').val();


		$.ajax({
        	url: "update-artist.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
		    	
		    	if (data.status === 'success') {
		    		swal("Update", "Successfully update the artist", "success");
		    		showArtist();
		    	} else {
		    		swal("Error", "Successfully update the artist", "error");
		    		showArtist();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });

	});

	$('#read-artist').click(function () {
		$('#read-artist').hide();
		$('#create-artist').show();
		showArtist();
	});

	function showArtist() {
		$('#page-content').load('read-artists.php');
		$('#read-artist').hide();
		$('#create-artist').show();
	}

	$('#filter_artist_name').keyup(function () {
		var artist_name = $('#filter_artist_name').val();
		var art_name=artist_name.trim().replace(/ /g, '%20');
		$('#page-content').load('read-artists.php?artist_name=' + art_name);
	});

});