$(document).ready(function () {

	$('#read-publisher').hide();


	showPublisher();

	$('#create-publisher').click(function () {
		$('#page-content').load('create-publisher-form.php');
		$('#read-publisher').show();
		$('#create-publisher').hide();
	});

	$(document).on('submit', '#create-publisher-form', function (event) {
		event.preventDefault();
		
		$.ajax({
        	url: "create-publisher.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {

		    	if (data.status === 'success') {

		    		swal("Saved", "Successfully create the new publisher", "success");
		    		showPublisher();
		    	} else if (data.status === 'exist') {
		    		swal("Error", "Publisher is already exist", "info");
		    		$('#page-content').load('create-publisher-form.php');
		    	} else {
		    		swal("Error", "Enable to create the new publisher", "error");
		    		showPublisher();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });

	});


	$(document).on('click', '#delete-publisher', function () {
		var publisher_id = $(this).closest('td').find('.publisher-id').text();
		swal({
            title: 'Are you sure delete this publisher?',
            text: 'You will not be able to recover this file!',
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
              $.post('delete-publisher.php', { publisher_id: publisher_id }).done(function (data) {
              	
              	if (data.status === 'success') {
              		swal(
              		  'Deleted!',
              		  'Your file has been deleted.',
              		  'success'
              		);
              		showPublisher();
              	} else {
              		swal(
              		  'Error!',
              		  'Unable to delete the publisher.',
              		  'error'
              		);
              		showPublisher();
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

	$(document).on('click', '#edit-publisher', function () {
		var publisher_id = $(this).closest('td').find('.publisher-id').text();
		$('#page-content').load('update-publisher-form.php?pub_id=' + publisher_id, function () {
			$('#read-publisher').show();
			$('#create-publisher').hide();
		});
	});

	$(document).on('submit', '#update-publisher-form', function (event) {
		event.preventDefault();
		var publisher_id = $('#publisher_id').val();


		$.ajax({
        	url: "update-publisher.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
		    	
		    	if (data.status === 'success') {
		    		swal("Update", "Successfully update the publisher", "success");
		    		showPublisher();
		    	} else if (data.status === 'exist') {
		    		swal("Error", "Publisher is already exist", "info");
		    		$('#page-content').load('update-publisher-form.php?pub_id=' + publisher_id);
		    	} else {
		    		swal("Error", "Successfully update the publisher", "error");
		    		showPublisher();
		    	}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
	    	} 	        
	   });

	});

	$('#read-publisher').click(function () {
		$('#read-publisher').hide();
		$('#create-publisher').show();
		showPublisher();
	});

	function showPublisher() {
		$('#page-content').load('read-publisher.php');
		$('#read-publisher').hide();
		$('#create-publisher').show();
	}

	// $('#filter_publisher_name').keyup(function () {
	// 	var publisher_name = $('#filter_publisher_name').val();
	// 	var pub_name=publisher_name.trim().replace(/ /g, '%20');
	// 	$('#page-content').load('read-publisher.php?publisher_name=' + pub_name);
	// });

});