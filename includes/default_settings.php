<?php
	$defaultSettings = array(
		"pagetitle" => array(
			"text" => "Page Title"
		),
		"favicon" => array(
			"display" => true,
			"url" => INDOT_UNDER_URL."assets/img/favicon.ico",
			"format" => "x-icon"
		),
		"logo" => array(
			"display" => true,
			"url" => INDOT_UNDER_URL."assets/img/indot-under150x150.png",
			"id" => -1
		),
		"title" => 	array(
			"display" => true,
			"text" => "My Title"
		),
		"description" => array(
			"display" => true, 
			"text" => "My Description"
		),
		"counter" => array(
			"display" => true, 
			"language" => "en", 
			"date" => date("Y-m-d",time()), 
			"time" => "T".date("H:i:s",time()),
			"cron" => false
		),
		"about" => array(
			"display" => true, 
			"text" => "My About :)"
		),
		"footer" => array(
			"display" => true, 
			"text" => "Copyright 2013 by Indot. All Rights Reserved."
		),
		"whitelist" => array(
			"enable" => false, 
			"iplist" => array(), 
			"rolelist" => array("Administrator")
		),
		"statuscode" => array(
			"enable" => false,
			"code" => 200,
			"redirect" => ""
		),
		"seo" => array(
			"enable" => false,
			"title" => "Page Title",
			"description" => "Awesome Under",
			"keywords" => "indot, under, wordpress, plugin, construction, lean",
			"author" => "Indot"
		)
	);
?>