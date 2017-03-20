$(document).ready(function () {
	$('#read-album').hide();

	showAlbums();

	$('#create-album').click(function () {
		$('#page-content').load("create-album-form.php");
		$('#read-album').show();
		$('#create-album').hide();
	});

	$(document).on('submit', '#create-album-form', function (e) {
		e.preventDefault();

		$.ajax({
        	url: "create-album.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
		    	if (data.status === 'success') {

		    		swal("Saved", "Successfully create the new album", "success");
		    		showAlbums();
		    	} else {
		    		swal("Error", "Unable to create the new album", "error");
		    		showAlbums();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });
		
	});

	$(document).on('click', '#edit-album', function () {
		var album_id = $(this).closest('td').find('.album-id').text();
		$('#page-content').load("update-album-form.php?album_id=" + album_id, function () {
			$('#read-album').show();
			$('#create-album').hide();	
		});
	});

	$(document).on('submit', "#update-album-form", function (e) {
		
		e.preventDefault();
		
		$.ajax({
        	url: "update-album.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
		    	
		    	if (data.status === 'success') {
		    		swal("Update", "Successfully update the new album", "success");
		    		showAlbums();
		    	} else {
		    		swal("Error", "Successfully update the new album", "error");
		    		showAlbums();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });
	});

	$(document).on('click', '#delete-album', function () {
		var album_id = $(this).closest('td').find('.album-id').text();
		swal({
            title: 'Are you sure delete this album?',
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
              $.post("delete-album.php", { album_id: album_id }).done(function (data) {
              	
              	if (data.status === 'success') {
              		swal(
              		  'Deleted!',
              		  'Your file has been deleted.',
              		  'success'
              		);
              		showAlbums();
              	} else {
              		swal(
              		  'Error!',
              		  'Unable to delete the album.',
              		  'error'
              		);
              	}
              	showAlbums();
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

	$('#read-album').click(function () {
		$('#read-album').hide();
		$('#create-album').show();
		showAlbums();
	});

	function showAlbums() {
		$('#page-content').load('read-album.php');
		$('#read-album').hide();
		$('#create-album').show();
	}

	$('#filter_album_name').keyup(function () {
		var album_name = $('#filter_album_name').val();
		var album_name=album_name.trim().replace(/ /g, '%20');
		$('#page-content').load('read-album.php?album_name=' + album_name);
	});

});