==============================================
Example: Insights with Plugin driven inputs
==============================================

In this approach, the end user would enter the fields necessary for the `interfaces` call when configuring the `plugin`

.. figure:: screenshots/interface_bugzilla_v3/plugin_fields.png
    :align: center

    Plugin screen

Choose this approach if the information needed to make the `interface` call is ( or should only be) known to the user who will be configuring the `plugin`

-  Download the contents of the folder
   `plugin_bugzilla_v2 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_bugzilla_v2>`__ to the folder "custom/plugin" 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/plugin_bugzilla_v2/bugzilla ~/cloudmunch/Install/custom/plugins

-  Download the contents of the folder
   `integration_bugzilla_v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/integration_bugzilla_v1>`__ to the folder "custom/integrations" 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/integration_bugzilla_v1/bugzilla ~/cloudmunch/Install/custom/integrations

-  Download the contents of the folder
   `interface_bugzilla_v3 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v3>`__ to the folder "custom/integrations" 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/interface_bugzilla_v3/bugzilla ~/cloudmunch/Install/custom/interfaces

- :doc:`rebuild_services`
- Create an :doc:`application<first_application>` and choose ``bugzilla`` as the resource 
- Add the integration & resource & exit the wizard
- Add a new task. 
- Add the plugin - You'll now see the fields in the ``plugin`` configuration. Enter the appropriate values.
- execute the task and once it completes, check the dashboard. You should see the following cards and key metrics:

.. figure:: screenshots/plugin_bugzilla_v1/insights.png
   :alt: Insight card
   :align: center

   Insight card

Interface
---------
As in the :doc:`insights_integration_inputs_example`, there is no need for a ``map`` node in the `interface <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v3/bugzilla/definition.json>`__ 

.. literalinclude:: ../examples/interface_bugzilla_v3/bugzilla/definition.json
   :language: json

.. literalinclude:: ../examples/interface_bugzilla_v3/bugzilla/definition.json
   :diff: ../examples/interface_bugzilla_v1/bugzilla/definition.json

`map is removed`

Integration
------------
The fields ``registrationFields`` are also now unnecessary in the `integration <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/integration_bugzilla_v2/bugzilla/definition.json>`__

.. literalinclude:: ../examples/integration_bugzilla_v1/bugzilla/definition.json
   :start-after: "events": []
   :end-before: "importFields": {}

.. literalinclude:: ../examples/integration_bugzilla_v1/bugzilla/definition.json
   :diff: ../examples/integration_bugzilla_v2/bugzilla/definition.json

`both the input fields are removed`

Plugin
------

Plugin Definition
~~~~~~~~~~~~~~~~~
A new node ``inputs`` is added to the `plugin <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_bugzilla_v2/bugzilla/plugin.json>`__

.. literalinclude:: ../examples/plugin_bugzilla_v2/bugzilla/plugin.json
   :start-after: "inputs": {
   :end-before: "outputs": {}
   :prepend: "inputs": {

Plugin code
~~~~~~~~~~~

In the `plugin` `source code <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/plugin_bugzilla_v2/bugzilla/src/Bugzilla.class.php>`__ the inputs to the `plugin` are passed to CloudMunch API

.. literalinclude:: ../examples/plugin_bugzilla_v2/bugzilla/src/Bugzilla.class.php
   :diff: ../examples/plugin_bugzilla_v1/bugzilla/src/Bugzilla.class.php