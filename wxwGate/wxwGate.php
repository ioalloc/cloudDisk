<?php

	$root = $_SERVER['SCRIPT_NAME'];
	$request = $_SERVER['REQUEST_URI'];

	$uri = array();

	$uri = array_filter(explode('/',$request));

	$controller = 'index';
	$method = 'index';

	if (count($uri) == 1) {
		$controller = $uri[1];
	}elseif (count($uri) == 2) {
		$controller = $uri[1];
		$method = $uri[2];
	}

	print_r($controller);
	print_r($method);

 ?>