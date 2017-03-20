<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Publishers</h1>
			<div id='create-publisher' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-plus'></span> Create Publisher
			</div>
			<div id='read-publisher' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-list'></span> Read Publisher
			</div>
			<hr>


		</section>
		<div class="content">
			<div class="clearfix"></div>
			<div id="page-content"></div>
		</div>
	</div>
<?php
	
	include('../includes/content-footer.php');

?>

<script type="text/javascript" src="publisher.js"></script>