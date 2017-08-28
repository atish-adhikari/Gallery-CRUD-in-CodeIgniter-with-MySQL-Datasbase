<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include '\partials\header.php'; ?>
<?php include '\partials\navbar.php'; ?>

<body>
	<?php 
		if($title == 'Albums') include '\templates\album.php'; 
		elseif($title == 'Add/Edit Album') include '\templates\album_form.php'; 
		elseif($title == 'View Album') include '\templates\view_album.php';
	?>
</body>
<?php include '\partials\footer.php'; ?>
</html>

