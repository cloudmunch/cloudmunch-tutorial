===========================
Example: Hello World Plugin
===========================

Plugins are CloudMunch's workhorses: how stuff gets done. Lets start with the simplest plugin possible: one that simply logs "Hello world" into the logs and exits.

-  Download the contents of the folder `hello-world-plugin-v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_hello_world_v1>`__ to the folder "custom/plugins" inside the CloudMunch installation folder.

- :doc:`rebuild_services`

-  Once the services are up, you can verify if the plugin has been added by invoking the API ``api/plugins/hello_world``.

.. figure:: screenshots/hello-world-plugin-v1/curl_verification.png
   :alt: curl verification

   curl verification

-  Once CloudMunch is up, create a new task and try to add this plugin to the task.

.. figure:: screenshots/cm-operations/add-plugin.gif
   :alt: Add the plugin
   :align: center

   Add the plugin

Troubleshooting 
~~~~~~~~~~~~~~~

If you don't see the plugin in the list, it may be because the JSON is not well formed or because of caching. Verify the JSON and clear cache `http://<your\_host>:8000/api/reset`

-  Modify the step, add the phrase you want to see, run the task and check the logs. You should see the phrase you entered in the logs.

.. figure:: screenshots/hello-world-plugin-v1/edit_and_run_task.gif
   :alt: Modify and run the task
   :align: center

   Modify and run the task

*(Run the task with different inputs to verify that the phrase you enter is what is displayed in the logs)*

Plugin files
-------------

Lets understand the files necessary for a plugin. Open up the `hello-world-plugin-v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_hello_world_v1/hello_world>`__ folder. Here you will find several files. Lets delve into a bit more
detail of the file: `plugin.json <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_hello_world_v1/hello_world/plugin.json>`__

Plugin Definition File
----------------------

.. literalinclude:: ../examples/plugin_hello_world_v1/hello_world/plugin.json
   :language: json

This file contains meta-data about the plugin you are adding and is used by us to display the configuration screen for a plugin. It is independent of the language your plugin will eventually be in.

The nodes: ``_created_by``, ``name``, ``description``, ``author``, ``id``, ``version`` and ``tags`` are pretty self-explanatory aren't they? So lets discuss ``status``, ``execute``, ``inputs`` & ``outputs``.

status
~~~~~~
The value in this node tells us whether to pick up your plugin or not. Plugins with any status other than ``enabled`` are ignored and will not be available for use within the system.

execute
~~~~~~~

.. literalinclude:: ../examples/plugin_hello_world_v1/hello_world/plugin.json
   :start-after: "status"
   :end-before: "inputs"

The contents of this node tell us which language the plugin is written in and where to find the plugin's executable. The languages we support today are ``PHP``, ``Java`` and ``Ruby``

inputs
~~~~~~

.. literalinclude:: ../examples/plugin_hello_world_v1/hello_world/plugin.json
   :start-after: "main": "hello_world/src/HelloWorld.class.php"
   :end-before: "outputs"

The contents of this node tell us what fields a user should see when configuring this plugin. 

In this example, there is a single **non-mandatory** **text** input field whose label is "Phrase". 

Change values of the nodes ``mandatory (true/false)``, ``display (yes/no)`` and ``label`` to see how the display and plugin behavior is changed. See :doc:`Configuration Driven UI<configuration_driven_ui>` to understand all the options possible.

outputs
~~~~~~~

The contents of this node tell us what variables are output by the plugin & available to the task after the plugin has completed execution. The values of these variables can be used to influence subsequent steps.

Plugins Src/Installation Files
------------------------------

Lets look at the other files necessary to add a plugin. In our example we have

-  src/<Name>.class.php: Actual logic necessary to perform the plugin's task.
-  composer.json: Composer file. Used to install the plugin and any of its dependencies
-  install.sh: Installs your plugin. You will typically never need to modify this file and can copy it from any other existing plugin

These other files are necessary based on the language your plugin will be written in. We are using PHP but :ref:`SDKs<refSDKs>` are also available in Ruby and Java. Do read the respective ReadMe.md files for detailed information on the syntax.

Plugin Logos
-------------

Did you notice that the plugin logo in the Hello World example was the CloudMunch logo? You can also add your own logo to a plugin. Just name the file: ``logo.png`` and put it under ``images`` (parallel to ``src``). When CloudMunch is rebuilt, the image will be copied as the logo of the plugin.