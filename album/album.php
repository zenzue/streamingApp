<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Albums</h1>
		    <div id='create-album' class='btn btn-primary pull-right'>
		        <span class='glyphicon glyphicon-plus'></span> Create Album
		    </div>
		    <div id='read-album' class='btn btn-primary pull-right'>
		        <span class='glyphicon glyphicon-list'></span> Read Album
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

<script type="text/javascript" src="album.js"></script>