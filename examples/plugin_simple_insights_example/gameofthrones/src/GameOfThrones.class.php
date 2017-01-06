<?php
    /* Copyright information */

    //Autoload loads the SDK this class will need
    require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/autoload.php';

    //Included for inheritence
    use CloudMunch \ AppAbstract;

    //Extend AppAbstract ( uses the Template pattern)
    class GameOfThrones extends AppAbstract {
        public function __construct() {}//optional constructor

        //Only method you *need* to implement
        public function process ( $processParameters ) {
            //Hardcoded resource ID that you need to replace for this to work
            $resourceID = "RES2017010607331179958";
            //A title for the card
            $source= "Tutorial";
            //Will display as a link in the card. User can click to go to the original source
            $sourceURL = "http://www.cloudmunch.com";
            //appInput will contain all the plugin's runtime variables
            $appInput = $processParameters['appInput'];
            //Log Handler to log progress and debug
            $this->getLogHandler()->log( INFO, "Beginning process" );
            //Get the utility necessary to create the report and key metrics
            $this->cmInsightsHelper = $this->getCloudmunchInsightHelper();
            /*Get & transform the data into the format the card expects.
            In this case you are creating a pie chart.
            (in the actual plugin, you'll do a lot more processing here)
            */
            $data = json_decode('{"alive(4)":4,"dead(1)":1}', true);
            //Add a label for the chart
            $data["label"]="Lannisters";//chart label
            //Create the card
            $reportID = $this->cmInsightsHelper->createDoughnutGraph($resourceID, 
              $data, "LannistersReport", "Lannisters Report", "Tutorial", "Death toll", 
              $source, $sourceURL, json_decode('["alive(4)","dead(1)"]') );
            //Create Key metrics card (Optional)
            $this->cmInsightsHelper->addKeyMetric( $resourceID, $reportID, "death_toll", 
              "Death Toll", 75, "percentage", $source, $sourceURL, "Number GRRM has killed" );
        }
    //End of process method
    }

    //Class instantiation & invocation
    $pluginInstance = new GameOfThrones();
    $pluginInstance->initialize();
    $processInput = $pluginInstance->getProcessInput();
    $pluginInstance->process( $processInput );
?>