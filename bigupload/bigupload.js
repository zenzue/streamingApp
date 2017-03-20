$(document).ready(function () {

	$('#page-content').load('bigupload-form.php');


	$(document).on('submit', '#bigupload-form', function (e) {
		e.preventDefault();

		$.ajax({

			url: "upload-big-data.php",
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
		    	console.log(data);
		    	// if (data.status === 'success') {
		    	// 	waitingDialog.hide();
		    	// 	swal("Saved", "Successfully create the new song", "success");
		    	// } else {
		    	// 	waitingDialog.hide();		
		    	// 	swal("Error", "Unable to create the new song", "error");
		    	// }
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 

		});
	});

});