$(document).ready(function () {

	$('#page-content').load('create_songs_albums_form.php');

		// $(document).on('submit', '#create-album-song-form', function (e) {
		// 	e.preventDefault();
			
		// 	$.ajax({
		// 		url: "create-song-album.php",
		// 		type: "POST",
		// 		data:  new FormData(this),
		// 		dataType: "json",
		// 		contentType: false,
	 //    	    cache: false,
		// 		processData:false,
		// 		beforeSend: function () {
		// 			$.magnificPopup.open({
		// 			  	items: {
		// 			    	src: 'loader.gif'
		// 			  	},
		// 			  		type: 'image'
		// 				}, 0);
		// 			},
		// 		success: function(data)
		// 	    {
		// 	    	$.magnificPopup.close();
		// 	    	if (data === 'failed') {
		// 	    		swal("Error", "Unable to create the new song", "error");
		// 	    		showSong();
		// 	    	} else {		    		
		// 	    		swal("Saved", "Successfully create the new song", "success");
		// 	    		showSong();
		// 	    	}
		// 	    },
		// 	  	error: function(e) 
		//     	{
		// 			$("#err").html(e).fadeIn();
		//     	} 
		// 	});

		// });

});