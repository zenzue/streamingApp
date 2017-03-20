<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Artists</h1>
			<div id='create-artist' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-plus'></span> Create Artist
			</div>
			<div id='read-artist' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-list'></span> Read Artist
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

<script type="text/javascript" src="artist.js"></script>