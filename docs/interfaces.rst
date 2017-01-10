==========
Interfaces
==========

An interface is simply configuration that tells CloudMunch what actions are possible on an Integration. 

Lets add a very simple interface for our integration: ``bugzilla``

-  Download the contents of the folder
   `interface_bugzilla_v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v1>`__ to the folder "custom/interfaces" inside the CloudMunch installation folder and :doc:`rebuild_services`

.. code-block:: bash
  
  $ cp -r ~/cloudmunch/cloudmunch-tutorial/examples/interface_bugzilla_v1/bugzilla ~/cloudmunch/Install/custom/interfaces
  

-  Once the services are up, you can verify if the resource has been added by invoking the API  ``api/interfaces/bugzilla``.

.. code-block:: bash
    
  $ curl http:/192.168.99.100:8000/api/interfaces/bugzilla?apikey=373ec269d3683736c82e4399b817cbbf24c08f20eebead1b6f856483ef43a0ba33dac304f4fb205daed4ab4815968515259c0d7108d52c705c88a8cd5a240a9b

  {"data":{"id":"bugzilla","name":"bugzilla","description":"Interface file for communicating with bugzilla","response":[{"message":"","condition":"==","result":"","error":"NO"}],"actions":{"get_bugs":{"base_url":"{configuration->url}","path":"/rest/bug?assigned_to={configuration->assigned_to}&component=Comp1&include_fields=id,assigned_to,creation_time,component,is_confirmed,is_open,last_change_time,priority,status,resolution","method":"GET"}}},"request":{"request_id":"R2017010908293530542","response_time":"0.22 seconds","status":"SUCCESS"}}


Our `interface` to bugzilla is ready. If you open the folder `interface_bugzilla_v1 <https://github.com/cloudmunch/cloudmunch-tutorial/tree/master/examples/interface_bugzilla_v1>`__, you'll see all we did was add a definition file. 

Interface Definition file
~~~~~~~~~~~~~~~~~~~~~~~~~

As in earlier cases, it is essentially just a JSON

Interface Definition
~~~~~~~~~~~~~~~~~~~~

The content below is the `interface` definition we added.

.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :language: json

This interface is very simple and contains only one node that needs elaboration: ``action``.

actions
-------
This node lists all the actions possible on the `interface`. (The key ``get_bugs`` is the action we'll invoke from within the plugin)
    -  path: the actual address to add to the base\_url to invoke for this action
    -  method: the method to invoke on the host
       
.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "actions": {
   :prepend: "actions": {

map
---
This node lists a mapping which will be used to replace runtime variables when the request is made. 

.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "Interface file for communicating with bugzilla"
   :end-before: "actions"

**NOTE**: You can explore and inspect all current interfaces with the following API

.. code:: bash

    /api/interfaces/<interface id>

If you don't pass the ID, you'll get back *all* the interfaces in the system.*

Summary
~~~~~~~
In this lesson, we created a simple `interface` we'll use to fetch information from Bugzilla. Next, lets add a `plugin` to get information from the `integration` ``bugzilla`` using it's `interface`.
