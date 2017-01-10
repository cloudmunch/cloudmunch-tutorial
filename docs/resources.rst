Resources
=========

A resource is essentially a source from which we fetch information. To add a resource into CloudMunch, we simply need to add its definition file.

Resource Definition
~~~~~~~~~~~~~~~~~~~

.. literalinclude:: ../examples/resource_bugzilla_v1/bugzilla/definition.json
   :language: json

**NOTE** Ensure the folder name and the value of the nodes ``id`` and ``type`` in the file match

The JSON file above is the definition of the integration. The fields ``id``, ``label``, ``type`` (``id``\ =\ ``type``) and ``description`` are self-explanatory. Lets consider the others 

integration
^^^^^^^^^^^
The value of this node tells CloudMunch what ``integration`` this ``resource`` belongs to. We'll be adding the Integration itself in a bit

component
^^^^^^^^^
This node is similar to ``label``. When adding a resource, the system may encounter some errors. The system will use the value of this node in the error messages.

category
^^^^^^^^
This node tells CloudMunch what category the resource belongs into. Remember this screen below? It is displayed in the application creation wizard. Resources are organized by Categories (see the vertical labels on the extreme left?). The category you enter will mostly be one of the existing ones from this screen. If you add a new one, the resource will still be disp layed, but in the new category you've entered. Remember to add at least one, resources without categories are **not** displayed in the UI.

.. figure:: screenshots/cm-operations/resource_categorization.png
    :alt: resource categorization
    :align: center

    Resource selection screen

fields
^^^^^^
This node tells CloudMunch what fields to display when someone is adding this resource into their application. Here, since we are adding a Google Sheets resource, we need the user to enter a name for the resource, the Sheet ID and the Range. The node follows CloudMunch's :doc:`Configuration Driven UI<configuration_driven_ui>` pattern.

Lets now add the resource to CloudMunch.

-  Download the contents of the folder `resource_bugzilla_v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/resource_bugzilla_v1>`__ to the folder "custom/resources" inside the CloudMunch installation folder.

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/resource_bugzilla_v1/bugzilla ./custom/resources

-  :doc:`rebuild_services`

-  Once the services are up, you can verify if the resource has been added by invoking the API ``/definitions/resource_types/bugzilla``

.. code-block:: bash
    
  $ curl http:/192.168.99.100:8000/api/definitions/resource_types/bugzilla?apikey=373ec269d3683736c82e4399b817cbbf24c08f20eebead1b6f856483ef43a0ba33dac304f4fb205daed4ab4815968515259c0d7108d52c705c88a8cd5a240a9b
  
  {"data":{"_created_by":"vivek@cloudmunch.com","documentation":{"description":
  "A simple insights plugin"},"author":"Vivek Kodira","id":"gameofthrones","name":
  "Game of Thrones Plugin","tags":[],"version":"1","status":"enabled","execute":
  {"options":"-debug","language":"PHP","main":"gameofthrones/src/GameOfThrones.class.php"},
  "inputs":{"phrase":{"type":"dummy_input_not_used", "label":"Ignore","mandatory":false,
  "display":"yes","defaultValue":"Dummy input. Not used"}},"outputs":{}},"request":
  {"request_id":"R2017010607092683581","response_time":"0.55 seconds","status":"SUCCESS"}}

A resource is only available within an integration. So before we can add this resource, we'll need an Integration. Lets add one next.