<?php
	/* Copyright information */

	//Autoload loads the SDK this class will need
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/autoload.php';

	//Included for inheritence
	use CloudMunch \ AppAbstract;

	//Extend AppAbstract ( uses the Template pattern)
	class GoogleSheet extends AppAbstract {
		public function __construct() {}//optional constructor

		private function putIntoDataStore( $response ) {
			$this->getLogHandler()->log( INFO, "Storing into datastore" );
		}

		//Only method you *need* to implement
		public function process ( $processParameters ) {
			$resourceID = "RES1234";
			$source= "Tutorial";
			$sourceURL = "Some excel path";
			//appInput will now contain all the plugin's runtime variables
			$appInput = $processParameters['appInput'];
			//Send some content to be put into the logs
			$this->getLogHandler()->log( INFO, "Beginning process" );

			$this->cmInsightsHelper = $this->getCloudmunchInsightHelper();
			$resources = $this->cmInsightsHelper->getResources('googlesheets');
			if (is_array($resources) && count($resources) > 0) {
				$data = '[{"Lanisters":{"alive":4,"dead":1}},{"Stark":{"alive":4,"dead":4}}]';
				//create data
				$transformedData = json_decode('{"alive(4)":4,"dead(1)":1}', true);
				$transformedData["label"]="Lannisters";//chart label
				$reportID = $this->cmInsightsHelper->createDoughnutGraph($resourceID, $transformedData, "LannisterReport", "Lanniter Report", "Tutorial", "Death toll", $source, $sourceURL, json_decode('["alive(4)","dead(1)"]') );
				$subtext="Number of ppl dead";
				$this->cmInsightsHelper->addKeyMetrics( $resourceID, $reportID, "Death Toll", 75, "percentage", $source, $sourceURL, $subtext )
			}
		}
	}

	//Class instantiation & invocation
	$googleSheet = new GoogleSheet();
	$googleSheet->initialize();
	$processInput = $googleSheet->getProcessInput();
	$googleSheet->process( $processInput );
?>