<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo( 'template_directory' );?>/blog.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head();?>
</head>

<body class="fntworksans">

	<div class="blog-masthead">
	<div class="container-fluid">
		<div class="col-md-2 pdng7"> 
		<img src="<?php echo get_template_directory_uri(); ?>/img/LogoSmall.png" alt="The Hd Tech Logo" class="Logo img-responsive">
		</div>
		<nav class="blog-nav col-md-6 fnt17 ">
			<a class="pdngmenu blog-nav-item active " href="#">Home</a>
			<?php wp_list_pages( '&title_li=' ); ?>
		</nav>
		<div class="col-md-3 pdng15 social-Network-Logo pull-right"> 
		<a href="#" class="textDecNone" ><i class="fa fa-facebook fa-2x" aria-hidden="true"></i> </a>
		<a href="#"  class="textDecNone" ><i class="fa fa-twitter fa-2x" aria-hidden="true"></i> </a>
		<a href="#"  class="textDecNone" ><i class="fa fa-instagram fa-2x" aria-hidden="true"></i> </a>
		</div>
	</div>
</div>

	<div class="container-fluid row">
	<section class="Banner-Area carousel">
	<!--<div class="Banner-Below pull-left"></div>-->
			<img src="<?php echo get_template_directory_uri(); ?>/img/logoshadow.png" alt="The Hd Tech Logo" class=" img-responsive titleimg carousel-caption center-block floatnone " width="150">
	
		<h2 class="title1 carousel-caption colorwhite Website-Name fntjosefin">
			<strong><?php echo get_bloginfo( 'name' ); ?></strong>
		</h2>
		<h4 class="title2 carousel-caption"><?php echo get_bloginfo( 'description' ); ?></h4>
	</section>
	
	</div>
	
	<div class="container">
	<div class="row">
		<div class="blog-header">
			<h2 class="blog-title fntjosefin text-center"><strong><a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a></strong</h2>
			<p class="lead blog-description  text-center"><?php echo get_bloginfo( 'description' ); ?></p>
		</div>
		<div class=" col-lg-10 col-lg-offset-1 ">