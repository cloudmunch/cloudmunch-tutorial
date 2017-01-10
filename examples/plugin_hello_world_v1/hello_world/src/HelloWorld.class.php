<?php
	/* Copyright information */

	//Autoload loads the SDK this class will need
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/autoload.php';

	//Included for inheritence
	use CloudMunch \ AppAbstract;

	//Extend AppAbstract ( uses the Template pattern)
	class HelloWorld extends AppAbstract {
		public function __construct() {}//optional constructor

		//Only method you *need* to implement
		public function process ( $processParameters ) {
			//appInput contains all the plugin's runtime variables
			$appInput = $processParameters['appInput'];
			//Send some content to be put into the logs
			$this->getLogHandler()->log( INFO, "Hello ".$appInput->phrase );
		}
	}

	//Class instantiation & invocation
	$helloWorld = new HelloWorld();
	$helloWorld->initialize();
	$processInput = $helloWorld->getProcessInput();
	$helloWorld->process( $processInput );
?>