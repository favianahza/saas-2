	    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<?php 

if( isset($_SESSION["logged_in"]) && isset($_SESSION["kabeng"]) ) {
	require_once 'modal.php';
	require_once 'edit.php';
} elseif( isset($_SESSION["logged_in"]) ){
	require_once 'edit.php';
} else {
	NULL;
}

?>

	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	    <script type="text/javascript" src="<?= base_url() . 'js/alert.js'?>"></script>
	    <?php if( isset($js) ) : ?>
	    <script src="<?= base_url() . 'js/' . "$js" ?>"></script>
		<?php endif; ?>
		<?php if( isset($js2) ) : ?>
	    <script src="<?= base_url() . 'js/' . "$js2" ?>"></script>
		<?php endif; ?>
		<?php if( isset($js3) ) : ?>
	    <script src="<?= base_url() . 'js/' . "$js3" ?>"></script>
		<?php endif; ?>		
  </body>
</html>