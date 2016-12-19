<?php
	/* Copyright information */

	//Autoload loads the SDK this class will need
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/autoload.php';

	use CloudMunch \ AppAbstract;

	class HelloWorld extends AppAbstract {
		public function __construct() {}//constructor
		public function process ( $processParameters ) {
			$appInput = $processParameters['appInput'];
			$this->getLogHandler()->log( INFO, "Hello ".$appInput->phrase );
		}
	}

	$helloWorld = new HelloWorld();
	$helloWorld->initialize();
	$processInput = $helloWorld->getProcessInput();
	$helloWorld->process( $processInput );
?>