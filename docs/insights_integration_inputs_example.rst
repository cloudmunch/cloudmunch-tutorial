================================================
Example: Insights with Integration driven inputs
================================================

In this approach, the end user can enter the fields necessary for the interface call when configuring the `integration` in the wizard

.. figure:: screenshots/interface_bugzilla_v2/integration_fields.png
    :align: center

    Integration screen

Choose this approach if the information needed to make the interface call should be visible to & editable by the end-user but when it does not change very often

-  Download the contents of the folder
   `interface_bugzilla_v2 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v2>`__ to the folder "custom/interfaces" 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/interface_bugzilla_v2/bugzilla ~/cloudmunch/Install/custom/interfaces

-  Download the contents of the folder
   `integration_bugzilla_v2 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/integration_bugzilla_v2>`__ to the folder "custom/integrations" 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/integration_bugzilla_v2/bugzilla ~/cloudmunch/Install/custom/integrations

- :doc:`rebuild_services`
- Create an :doc:`application<first_application>` and choose ``bugzilla`` as the resource 
- You'll be prompted to create an integration and see the fields you just specified. 
- Add the same values we'd seen in the interface earlier (see below) and click "Next". 

.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "Interface file for communicating with bugzilla"
   :end-before: "actions"

- Add a resource
- Exit the wizard
- Add a new task. Add the plugin, execute the task and once it completes, check the dashboard. You should see the following cards and key metrics:

.. figure:: screenshots/plugin_bugzilla_v1/insights.png
   :alt: Insight card
   :align: center

   Insight card

Interface
---------

The node ``map`` is removed from the `interface <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v2/bugzilla/definition.json>`__

.. literalinclude:: ../examples/interface_bugzilla_v2/bugzilla/definition.json
   :language: json

.. literalinclude:: ../examples/interface_bugzilla_v2/bugzilla/definition.json
   :diff: ../examples/interface_bugzilla_v1/bugzilla/definition.json

`The node ``map`` has been removed in v2 of the interface`

Integration
-----------

The `integration <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/integration_bugzilla_v2/bugzilla/definition.json>`__  now contains these as ``registrationFields``

.. literalinclude:: ../examples/integration_bugzilla_v2/bugzilla/definition.json
   :start-after: "events": []
   :end-before: "importFields": {}

Plugin
------
There is no difference in the plugin from the earlier example