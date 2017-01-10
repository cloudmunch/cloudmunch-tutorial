OAuth issue in resource
=======================

.. figure:: screenshots/resource_googlesheets_v1/resource_wizard.gif
   :alt: Oauth issue

   Oauth issue

We've hit a snag. This Wizard (which at the moment is the only way you can do this exercise) sees that you've configured the integration as needing OAuth. It calls the action ``authorize`` on the integration but this action is not defined anywhere. Lets add an interface to fix this problem.


.. figure:: screenshots/interface_googlesheets_v1/OAuthFlow.png
    :alt: Google Oauth
    
    Google's OAuth is not a single step process. It involves multiple calls to the API where we first authenticate the client, get user authorization, get a code and then use code to get an Access Token. This Access token is what is used in subsequent requests to the API. This means the interface file has to be capable of not just defining what actions are possible on an Integration but also chaining those actions automatically.


Interface complex definition
============================
-  configuration: This node contains details on the base url that subsequent actions will need to invoke along with the protocol, header and any IDs/secrets
-  map: Think of this node as a global object available to all actions. When the action is invoked, any keys that match this map's keys will be replaced with the map's values. In this example, any parameters which expect a emailID will get the current user's user ID.

	-  input: The params to be added to the url. These will be based on the OAuth documentation of the system you are interacting with.
    -  output: The response sent back from the third-party-system
    -  condition: The conditions under which this action needs to be performed. In this example, the condition checks the integration to see if an access token is already available. If one is, the operation simply completes without accessing the third-party-system again. 
    -  parameters: Imagine that a action is a method you call on CloudMunch's API, these are the parameters that method expects to see. Internally, these parameters may get converted into the inputs you saw above or used internally for some processing. In the action "authorize" below, the application and integration IDs are necessary since the integration will be updated with the access token returned by Google.
    -  next\_action: Tells CloudMunch what to do after the response comes back. In this case, CloudMunch makes another call to Google (passing the state it got back and expecting back an access token)