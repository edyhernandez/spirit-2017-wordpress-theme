<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <?php wp_head();?>
  </head>

  <body>
	<header>
		<div id="headerimg">
		   	<h1>
		    	<a href="<?php echo get_option('home'); ?>">
		       	<?php bloginfo('name'); ?></a>
		   	</h1>
		   	<div class="description">
		    	<?php bloginfo('description'); ?>
		   	</div>
  		</div>
	</header>