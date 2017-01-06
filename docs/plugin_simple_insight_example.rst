=======================
Simple Insight Plugin
=======================

Now that you are familiar with a plugin, lets create with a simple insights plugin

-  `Create :doc: `an empty application <first_application>` an application without any resources, integrations or tasks
-  Copy the application's ID (referred to here after as ``application_id``). We'll need it in the APIs we'll call.
-  Create a resource in your application by invoking the API ``/api/applications/<application_id>/resources``. The data we'll send to create a resource is below. Replace the application\_id with the correct value. The application\_name is a reference and can remain as-is.

*If you don't know what a resource is yet, don't worry. For now, just think of it as the source of the data*

.. code:: json

    {
      "type": "gameofthrones",
      "name": "Game of Thrones",
      "created_date": "2016-12-20 06:56:11.73265",
      "created_by": "__yourID__",
      "updated_by": "__yourID__",
      "updated_date": "2016-12-20 06:56:11.73265",
      "application_id": "__application_id__",
      "application_name": "{$applications->name}"
    }

-  Example invocation and response:

**NOTE**: If copy-pasting these lines, please remove the newlines first. They've been added for readability.

.. code-block:: bash
    :emphasize-lines: 13

    $ curl --data 'data={"type":"gameofthrones","name":"Game of Thrones",
    "created_date":"2016-12-20 06:56:11.73265","created_by":"vivek@cloudmunch.com",
    "updated_by": "vivek@cloudmunch.com","updated_date":"2016-12-20 06:56:11.73265",
    "application_id":"APP2016122308383772923","application_name":"{$applications->name}"}'
    http://192.168.99.100:8000/api/applications/APP2016122308383772923/
    resources?apikey=ceb01fa31b53c14cd04b542c50459cceb62eb43ab883190a33a39
    a5111ba24ded5c39426b362039ac72abaf31f3c5eac246a538e76d36b328be066248a066361
    
    {"data":{"type":"gameofthrones","name":"Game of Thrones",
    "created_date":"2016-12-23 08:58:40.23489","created_by":"vivek@cloudmunch.com",
    "updated_by":"vivek@cloudmunch.com","updated_date":"2016-12-23 08:58:40.23489",
    "application_id":"APP2016122308383772923","application_name":"CMforDummies",
    "id":"RES2016122308584024026"},"request":{"request_id":"R2016122308583994943",
    "response_time":"0.39 seconds","status":"SUCCESS"}}

-  Notice the ``"id":"RES2016122308584024026"`` in the response? This is the ID allocated to your resource. We'll use it in the stubbed plugin 

-  Open the file `GameOfThrones.class.php <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_simple_insights_example/gameofthrones/src/GameOfThrones.class.php>`__ 

  -  edit the line ``$resourceID = "";``\ and replace the actual resource ID as the value.

-  Download the contents of the folder `plugin_simple_insights_example <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_simple_insights_example>`__ to the folder "custom/plugins" inside the CloudMunch installation folder.

-  Switch to the command prompt, navigate to the CloudMunch installation folder and :doc:`Rebuild Services<rebuild_services>`

-  Once the services are up, you can verify if the plugin has been added by invoking the API ``api/plugins/gameofthrones``.

.. code-block:: bash
    
  $ curl http:/192.168.99.100:8000/api/plugins/gameofthrones?apikey=79eaf7ee17664bb5ba4ca4ed2a27dd0c9c3efe410182c7caa8031642efbc
  adc46d1d6d0214930dba5e9e814ce5bbbba4295bca96bac766c04e6410770de07219
  
  {"data":{"_created_by":"vivek@cloudmunch.com","documentation":{"description":
  "A simple insights plugin"},"author":"Vivek Kodira","id":"gameofthrones","name":
  "Game of Thrones Plugin","tags":[],"version":"1","status":"enabled","execute":
  {"options":"-debug","language":"PHP","main":"gameofthrones/src/GameOfThrones.class.php"},
  "inputs":{"phrase":{"type":"dummy_input_not_used", "label":"Ignore","mandatory":false,
  "display":"yes","defaultValue":"Dummy input. Not used"}},"outputs":{}},"request":
  {"request_id":"R2017010607092683581","response_time":"0.55 seconds","status":"SUCCESS"}}

-  Add a new task. Add the plugin, execute the task and once it completes, check the dashboard. You should see the following cards and key metrics:

.. figure:: screenshots/plugin_simple_insights_example/insights.png
    :alt: Insights
  
    Insights

Our (rather sombre) Insights are ready. Go over to :doc:`Insights <insights>` if you want to read up more about Insights. Come back and continue when ready.

Plugin Source Code Walkthrough
------------------------------

The work is done by `GameOfThrones.class.php <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_simple_insights_example/gameofthrones/src/GameOfThrones.class.php>`__ . Lets look at the contents of the file:

.. literalinclude:: ../examples/plugin_simple_insights_example/gameofthrones/src/GameOfThrones.class.php
   :language: php

All the work is done by the `process` method

.. literalinclude:: ../examples/plugin_simple_insights_example/gameofthrones/src/GameOfThrones.class.php
   :language: php
   :prepend: <?php
   :append: ?>
   :start-after: Only method you *need* to implement
   :end-before: End of process method
   :dedent: 4

For more information on the utilities used, please refer to the `SDK documentation <https://github.com/cloudmunch/CloudMunch-php-SDK-V2>`__

Done! You now know what the output will look like. Next, we will create an actual resource that the end-user can see and configure.

Troubleshooting
~~~~~~~~~~~~~~~

"Found no reports for this resource"
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you see this message or don't see any cards, you've most likely forgotten to update or updated the wrong ID of the resource ID in the plugin. Update and redo the process of adding the plugin to CloudMunch.

.. todo::
  Change this example to avoid the user having to create a resource. Instead, do it implicitly from within the plugin