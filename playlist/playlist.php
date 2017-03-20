<?php

	include('../includes/content-header.php');

?>

	<div class="content-wrapper">
		<section class="content-header">
		    <h1 class="pull-left">Playlist</h1>
			<div id='create-playlist' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-plus'></span> Create Playlist
			</div><br><br>
			<div id='read-playlist' class='btn btn-primary pull-right'>
			    <span class='glyphicon glyphicon-list'></span> Read Playlist
			</div>
			<input type="hidden" id="song_id" name="song_id" value="<?php echo $_GET['song_id'];?>">

		</section>
		<div class="content">
			<div class="clearfix"></div>
			<div id="page-content"></div>
		</div>
	</div>
<?php
	
	include('../includes/content-footer.php');

?>

<script type="text/javascript" src="playlist.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>