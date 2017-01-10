<?php
	/* Copyright information */

	//Autoload loads the SDK this class will need
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/autoload.php';

	//Included for inheritence
	use CloudMunch \ AppAbstract;


	//Extend AppAbstract ( uses the Template pattern)
	class Bugzilla extends AppAbstract {
		/**
	    * Get integration details from cloudmunch
	    *
	    * @param string integrationID : id of integration
	    * @param string action        : action to be executed
	    * @param string data          : any data to be passed to interface
	    *         
	    * @return json response from api interface action
	    */
	    public function callInterfaceAction($cmService, $integrationID, $action, $data = array()){
	      return $cmService->updateCustomContextData(array('integrations' => $integrationID), $data, "POST", array('action' => $action) );
	    }

		public function __construct() {}//optional constructor

		//Only method you *need* to implement
		public function process ( $processParameters ) {
			//appInput contains all the plugin's runtime variables
			$appInput = $processParameters['appInput'];
			//Get the utility to add insights
			$this->cmInsightsHelper = $this->getCloudmunchInsightHelper();
			//Get all the resources of this type (bugzilla)
			$resources   = $this->cmInsightsHelper->getResources('bugzilla');
			//get the utility used to make Cloudmunch API calls
			$cmService = $this->getCloudmunchService();
			//Verify that there is at least one resource
			if(is_array($resources) && count($resources) > 0){
				//For each resource
            	foreach ($resources as $key => $resource) {
            		//Get the ID of the resource
		            $resourceID = $resource->id;
		            //Log progress
		            $this->getLogHandler()->log( INFO, "Beginning processing for resource" . $resource->name );
            		//prepare an object to hold the graph information
					$transformedData = array();
            		//Get the resource's integration ID
            		$integrationID = $resource->integration_id;
            		//Fetch information for the resource (using the method you defined in the interface)
            		$response = $this->callInterfaceAction( $cmService, $integrationID, "get_bugs", array(
            			assigned_to => $appInput->assigned_to,
            			bugzilla_url => $appInput->bugzilla_url
            		) );
            		if ($response ===  false){
            			//Log error
            			$this->getLogHandler()->log( ERROR, "Aborting plugin execution due to interface error" );
            			return;
            		}
            		//php stuff (Convert the stdclass object to an associative array)
            		$response = json_decode( json_encode( $response), true );
            		//php stuff (extract the key "bugs")
            		$response = $response["bugs"];

            		//Iterate through the returned response from the interface (a list of bugs)
            		if(is_array($response) && count($response) > 0){
            			//For each bug
            			foreach ($response as $key => $bug) {
            				//Collect the count of bugs by priority
            				$priority = $bug[ "priority" ];
            				if ( !array_key_exists( $priority, $transformedData) ) {
            					$transformedData[$priority] = 1;
            				} else {
            					$transformedData[$priority] = $transformedData[$priority] + 1;
            				}
            			}//End of for loop for response
            		}//End of if check for response
            		//Get an array containing just the priority labels (will be displayed in the legend)
            		$keysArray = array_keys($transformedData);
		            //Add a label for the chart
		            $transformedData["label"]="Bug distribution";//chart label
		            //Create the card using the utility
		            $reportID = $this->cmInsightsHelper->createDoughnutGraph( $resourceID, 
		            $transformedData, "Bug distribution", "Bug distribution", "Tutorial",
		            "Bug distribution", "Tutorial", "http://www.cloudmunch.com", $keysArray );
		            //Log progress
		            $this->getLogHandler()->log( INFO, "Finished processing for resource" . $resource->name );
            	}//End of for loop for each resource
            }
		}
		//End of process method
	}

	//Class instantiation & invocation
	$bugzilla = new Bugzilla();
	$bugzilla->initialize();
	$processInput = $bugzilla->getProcessInput();
	$bugzilla->process( $processInput );
?>