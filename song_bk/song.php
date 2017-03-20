<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Songs</h1>
		    <div id='create-song' class='btn btn-primary pull-right'>
		        <span class='glyphicon glyphicon-plus'></span> Create Song
		    </div><br><br>
		    <div id='read-song' class='btn btn-primary pull-right'>
		        <span class='glyphicon glyphicon-list'></span> Read Song
		    </div>
		    <div id='unknown-album' class='btn btn-primary'>
		        <span class='glyphicon glyphicon-list'></span> Unknown Album
		    </div>


		</section>
		<div class="content">
			<div class="clearfix"></div>
			<div id="page-content"></div>
		</div>
	</div>
<?php
	
	include('../includes/content-footer.php');

?>

<script type="text/javascript" src="song.js"></script>