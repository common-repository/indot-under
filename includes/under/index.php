<?php
	$IndotUnderSettings = get_option('IndotUnderSettings');
	wp_enqueue_style( 'indot-normalize-css', INDOT_UNDER_URL . 'includes/under/css/normalize.css');
	wp_enqueue_style( 'indot-style-css', INDOT_UNDER_URL . 'includes/under/css/style.css');
	wp_enqueue_style( 'indot-font-css', 'http://fonts.googleapis.com/css?family=Offside');
	wp_enqueue_script( 'jquery');
	if($IndotUnderSettings["counter"]["display"]){
		wp_enqueue_script('indot-counter-display', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown.js', array('jquery'));
		if($IndotUnderSettings["counter"]["language"] == "pt"){
			wp_enqueue_script('indot-counter-display-pt', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown-pt-BR.js', array('jquery','indot-counter-display'));
		}
		if($IndotUnderSettings["counter"]["language"] == "es"){
			wp_enqueue_script('indot-counter-display-es', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown-es.js', array('jquery','indot-counter-display'));
		}
		if($IndotUnderSettings["counter"]["language"] == "fr"){
			wp_enqueue_script('indot-counter-display-fr', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown-fr.js', array('jquery','indot-counter-display'));
		}
		if($IndotUnderSettings["counter"]["language"] == "de"){
			wp_enqueue_script('indot-counter-display-de', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown-de.js', array('jquery','indot-counter-display'));
		}
		if($IndotUnderSettings["counter"]["language"] == "it"){
			wp_enqueue_script('indot-counter-display-it', INDOT_UNDER_URL . 'includes/under/js/jquery.countdown-it.js', array('jquery','indot-counter-display'));
		}
		wp_enqueue_script('indot-counter-display-script', INDOT_UNDER_URL . 'includes/under/js/script.js', array('jquery','indot-counter-display'));
	}
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<?php 
		global $wp_styles;
		do_action('wp_footer', $wp_styles->queue);
	?>
	<title><?php echo $IndotUnderSettings["pagetitle"]["text"];?></title>
	<?php if($IndotUnderSettings["seo"]["enable"]){?>
	<meta name="title" content="<?php echo $IndotUnderSettings['seo']['title']; ?>">
	<meta name="description" content="<?php echo $IndotUnderSettings['seo']['description']; ?>">
	<meta name="keywords" content="<?php echo $IndotUnderSettings['seo']['keywords']; ?>">
	<meta name="author" content="<?php echo $IndotUnderSettings['seo']['author']; ?>">
	<?php }?>
	<?php if($IndotUnderSettings["favicon"]["display"]){?>
		<?php if($IndotUnderSettings["favicon"]["format"] == "x-icon"){?>
			<link rel="shortcut icon" href="<?php echo $IndotUnderSettings["favicon"]["url"]; ?>" />
		<?php } else if($IndotUnderSettings["favicon"]["format"] == "png"){ ?>
			<link rel="icon" type="image/png" href="<?php echo $IndotUnderSettings["favicon"]["url"]; ?>" />
		<?php } else if($IndotUnderSettings["favicon"]["format"] == "gif"){ ?>
			<link rel="icon" type="image/gif" href="<?php echo $IndotUnderSettings["favicon"]["url"]; ?>" />
		<?php } else { ?>
			<link rel="shortcut icon" href="<?php echo INDOT_UNDER_URL."assets/img/favicon.ico"; ?>" />
		<?php } ?>
	<?php } else{ ?>
		<link rel="shortcut icon" href="<?php echo INDOT_UNDER_URL."assets/img/favicon.ico"; ?>" />
	<?php }?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<div class="barracima"></div>	
	<div class="area">
		<div class="wrapper">
			<?php if($IndotUnderSettings["logo"]["display"]){?>
			<div id="logo">
				<?php
				if($IndotUnderSettings["logo"]["id"] != -1)
					echo wp_get_attachment_image( $IndotUnderSettings["logo"]["id"], "indot_under_img");
				else{ ?>
				<img src="<?php echo INDOT_UNDER_URL.'assets/img/indot-under350x250.png'; ?>" />
				<?php }?>
			</div>
			<?php }?>
			<?php if($IndotUnderSettings["title"]["display"]){?>
			<h1 id="title" <?php if($IndotUnderSettings["logo"]["display"]){ echo "style='font-size:50px!important'"; }?>>
				<?php echo $IndotUnderSettings["title"]["text"];?>
			</h1>
			<?php }?>

			<?php if($IndotUnderSettings["description"]["display"]){?>
			<h2 id="desc">
				<?php echo $IndotUnderSettings["description"]["text"];?>
			</h2>
			<?php }?>
			
			<?php if($IndotUnderSettings["counter"]["display"]){?>
			<div id="timer">
				<input type="hidden" value="<?php echo $IndotUnderSettings['counter']['date'].' '.ltrim($IndotUnderSettings['counter']['time'],'T');?>" id="valueDateTime" />
				<input type="hidden" value="<?php echo get_option('gmt_offset'); ?>" id="valueDateTimeOffset" />
			</div>
			<?php }?>
			<?php if($IndotUnderSettings["about"]["display"]){?>
			<div id="about">
				<?php echo $IndotUnderSettings["about"]["text"];?>
			</div>
			<?php }?>
			<?php if($IndotUnderSettings["footer"]["display"]){?>
			<div id="footer">
				<?php echo $IndotUnderSettings["footer"]["text"];?>
			</div>
			<?php }?>
		</div>

	</div>
</body>
</html>