Integrations
------------
Integrations are essentially references to third-party systems (Ex: Google, Jira, Sonarqube). Before you can access a resource, an instance of that integration (containing your credentials) should be added to the application. Adding an integration into CloudMunch involves adding a single definition file. Lets add one to represent Bugzilla.

Integration Definition
~~~~~~~~~~~~~~~~~~~~~~
.. literalinclude:: ../examples/integration_bugzilla_v1/bugzilla/definition.json
   :language: json

The JSON file above is the definition of the integration. The fields ``id`` (should be same as the folder name), ``label``, ``type`` (``id``\ =\ ``type``), ``display``, ``status`` and ``description`` are self-explanatory so lets look at ``registrationFields``.

registrationFields
^^^^^^^^^^^^^^^^^^

.. literalinclude:: ../examples/integration_bugzilla_v1/bugzilla/definition.json
   :start-after: "events": []
   :end-before: "importFields"

Here, we are specifying that when adding an integration of type Bugzilla, ask the user for two mandatory pieces of information: the URL and the person's ID. The node follows CloudMunch's :doc:`Configuration Driven UI<configuration_driven_ui>` pattern.

Lets now add the integration to CloudMunch.

-  Download the contents of the folder `integration_bugzilla_v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/integration_bugzilla_v1>`__
   to the folder "custom/integrations" inside the CloudMunch installation folder 

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/integration_bugzilla_v1/bugzilla ~/cloudmunch/Install/custom/integrations

- :doc:`rebuild_services`

-  Once the services are up, you can verify if the resource has been added by invoking the API ``/api/definitions/integrations/bugzilla``

.. code-block:: bash
    
  $ curl http:/192.168.99.100:8000//api/definitions/integrations/bugzilla?apikey=373ec269d3683736c82e4399b817cbbf24c08f20eebead1b6f856483ef43a0ba33dac304f4fb205daed4ab4815968515259c0d7108d52c705c88a8cd5a240a9b

Integration Logos
~~~~~~~~~~~~~~~~~
You can also add your own logo to an integration. Just name the file: ``logo.png`` and put it under ``images``. When CloudMunch is rebuilt, the image will be copied as the logo of the integration.

Cool! Now we have a resource and its integration. Go to the application, click on "Add Insights", choose the resource "Bugzilla" and click "Next". There's the Integration we added. Change the name if necessary and click on "Next". A pre-configured Insight Task in the application will get triggered. 

**But**, there is a problem. We've not modified this task to fetch data from our new resource. To do that we first need a ``plugin`` and for the plugin to be able to fetch data from an external system, we need an interface. Lets look at adding an interface next.