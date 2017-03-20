$(document).ready(function () {

	showGenere();

	$(document).on('click','#create-genere',function () {
		$('#page-content').load('create-genere-form.php');
		$('#read-genere').show();
		$('#create-genere').hide();
	});

	$(document).on('click', '#read-genere', function () {
		$('#page-content').load('read-genere.php');
		$('#read-genere').hide();
		$('#create-genere').show();
	});


	$(document).on('submit', '#create-genere-form', function (e) {
		e.preventDefault();

		$.ajax({

			url : "create-genere.php",
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			contentType: false,
    	    cache: false,
			processData:false,
			success : function (data) {
				
				if (data.status === 'success') {

					swal("Saved", "Successfully create the new generes", "success");
					showGenere();
				} else if (data.status === 'failed') {
					showGenere();
					swal("Error", "Unable to create the new generes", "error");
				}

			},
			error : function (e) {
				console.log(e);	
			}

		});

	});


	$(document).on('click', '#edit-genere', function () {
		var genere_id = $(this).closest('td').find('.genere-id').text();
		$('#page-content').load('update-genere-form.php?genere_id=' + genere_id, function () {
			$('#read-genere').show();
			$('#create-genere').hide();
		});


	});


	$(document).on('click', '#delete-genere', function () {
		var genere_id = $(this).closest('td').find('.genere-id').text();
		swal({
	        title: 'Are you sure delete this generes?',
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
	          $.post('delete-genere.php', { genere_id: genere_id }).done(function (data) {
	          	
	          	if (data.status === 'success') {
	          		swal(
	          		  'Deleted!',
	          		  'Your file has been deleted.',
	          		  'success'
	          		);
	          		showGenere();
	          	} else {
	          		swal(
	          		  'Error!',
	          		  'Unable to delete the artist.',
	          		  'error'
	          		);
	          		showGenere();
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

	$(document).on('submit', '#update-genere-form', function (e) {

				e.preventDefault();

				$.ajax({

					url : "update-genere.php",
					type: "POST",
					data:  new FormData(this),
					dataType: "json",
					contentType: false,
		    	    cache: false,
					processData:false,
					success : function (data) {
						
						if (data.status === 'success') {

							swal("Saved", "Successfully update the new generes", "success");
							showGenere();
						} else if (data.status === 'failed') {
							showGenere();
							swal("Error", "Unable to update the new generes", "error");
						}

					},
					error : function (e) {
						console.log(e);	
					}

				});



	});

	function showGenere() {
		$('#read-genere').hide();
		$('#create-genere').show();
		$('#page-content').load('read-genere.php');
	}


});