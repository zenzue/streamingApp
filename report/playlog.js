$(document).ready(function () {

	$('#page-content').load('read-playlog.php');

	$(document).on('click', '#search', function () {


		fromdate = $('#txtfromdate').val();
		todate = $('#txttodate').val();
		publisher = $('#publisher').val();

		alert(fromdate + "|" + todate + "|" + publisher);


		// $('#page-content').load('read-playlog.php', {
		// 	fromdate: fromdate, 
		// 	todate: todate,
		// 	publisher: publisher
		// });

	});

});