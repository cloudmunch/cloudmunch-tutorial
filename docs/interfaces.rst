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
Think of this node as a global object available to all actions. When the action is invoked, any keys that match this map's keys will be replaced with the map's values. In this example, any parameters which expect a emailID will get the current user's user ID

.. literalinclude:: ../examples/interface_bugzilla_v1/bugzilla/definition.json
   :start-after: "Interface file for communicating with bugzilla"
   :end-before: "actions"

.. todo::
         How to transform returned data from third-party systems, using output section.

.. note::

  You can explore and inspect all interfaces with the API `/api/interfaces/<interface id>`. If you don't pass the ID, you'll get back definitions for *all* the interfaces in the system
