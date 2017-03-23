<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Playlog</h1>
		    <div class="clearfix"></div>
		    <hr>
		</section>
		<div class="content">
			<div class='col-md-3'>
			    <div class="form-group">
			        <div class='input-group date' id='fromdate'>
			            <input type='text' class="form-control" id="txtfromdate"/>
			            <span class="input-group-addon">
			                <span class="glyphicon glyphicon-calendar"></span>
			            </span>
			        </div>
			    </div>
			</div>
			<div class='col-md-3'>
			    <div class="form-group">
			        <div class='input-group date' id='todate'>
			            <input type='text' class="form-control" id="txttodate"/>
			            <span class="input-group-addon">
			                <span class="glyphicon glyphicon-calendar"></span>
			            </span>
			        </div>
			    </div>
			</div>

			<div class='col-md-3'>
			    <div class="form-group">
			        <div class='input-group'>
			            <input type='text' class="form-control" id="publisher"/>
			        </div>
			    </div>
			</div>

			<div class="con-md-3">
				<button class="btn btn-primary" id="search">Search</button>

			</div>

			<div class="clearfix"></div>
			<div id="page-content"></div>
		</div>
	</div>
<?php
	
	include('../includes/content-footer.php');

?>
<script type="text/javascript">
	
	$(function () {
	    $('#fromdate').datetimepicker({
	    	format: 'YYYY-MM-DD'
	    });
	    $('#todate').datetimepicker({
	       	format: 'YYYY-MM-DD',
	       	useCurrent: false //Important! See issue #1075
	    });
	    $("#fromdate").on("dp.change", function (e) {
	        $('#todate').data("DateTimePicker").minDate(e.date);
	    });
	    $("#todate").on("dp.change", function (e) {
	        $('#fromdate').data("DateTimePicker").maxDate(e.date);
	    });
	});
</script>
<script type="text/javascript" src="playlog.js"></script>