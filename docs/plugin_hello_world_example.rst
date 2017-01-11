===========================
Example: Hello World Plugin
===========================

Lets start with the simplest plugin possible: one that simply logs "Hello world" into the logs and exits.

Setup
=====
-  Download the contents of the folder `hello-world-plugin-v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_hello_world_v1>`__ to the folder "custom/plugins" inside the CloudMunch installation folder.

- :doc:`rebuild_services`

Application
===========
-  Once CloudMunch is up, create a new task and try to add this plugin to the task.

.. figure:: screenshots/cm-operations/add-plugin.gif
   :alt: Add the plugin
   :align: center

   Add the plugin

-  Modify the step, add the phrase you want to see, run the task and check the logs. You should see the phrase you entered in the logs.

.. figure:: screenshots/hello-world-plugin-v1/edit_and_run_task.gif
   :alt: Modify and run the task
   :align: center

   Modify and run the task

Troubleshooting
===============
If you don't see the plugin in the ui, it may be because the JSON is not well formed or because of caching. Verify the JSON and clear cache
