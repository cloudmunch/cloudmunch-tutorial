==========
Interfaces
==========

An interface is simply configuration that tells CloudMunch what actions are possible on an Integration. Adding an interface involves adding its definition.

Sample Interface Definition file
--------------------------------
.. literalinclude:: ../examples/interface_bugzilla_v3/bugzilla/definition.json
   :language: json

Lets look at each node in detail:

actions
-------
This node lists all the actions possible on the `interface`. 
    -  The key ``get_bugs`` is the action we'll invoke internally
    -  path: the actual external address to invoke for this action
    -  method: the method to invoke on the host
    -  input: These will be passed as parameters in the request
       
.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "actions": {
   :prepend: "actions": {

map
---
This node lists a mapping which will be used to replace runtime variables when the request is made.

.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "Interface file for communicating with bugzilla"
   :end-before: "actions"

.. note::

  You can explore and inspect all interfaces with the API `/api/interfaces/<interface id>`. If you don't pass the ID, you'll get back definitions for *all* the interfaces in the system