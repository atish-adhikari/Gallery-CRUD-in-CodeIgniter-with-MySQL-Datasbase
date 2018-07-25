<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include(__DIR__.'/partials/header.php'); ?>
<?php include(__DIR__.'/partials/navbar.php'); ?>

<body>
	<?php 
		if($title == 'Albums') include(__DIR__.'/templates/album.php'); 
		elseif($title == 'Add/Edit Album') include(__DIR__.'/templates/album_form.php'); 
		elseif($title == 'View Album') include(__DIR__.'/templates/view_album.php');
	?>
</body>
<?php include(__DIR__.'/partials/footer.php'); ?>
</html>

