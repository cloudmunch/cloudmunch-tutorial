Configuration Driven UI
-----------------------

CloudMunch's UI easily supports configuring third-party tools and
integrations. We do this by implementing a pattern we call
"Configuration Driven UI". You, the developer of the third-party tool,
tell us what we should show on screen through a simple JSON. Our
framework parses the JSON and renders your configuration as HTML. The
table below demonstrates how UI changes based on content in the JSON.

+----------------------+----------------------------+
| Definition           | UI                         |
+======================+============================+
| |plugin.json file|   | |How it looks in the UI|   |
+----------------------+----------------------------+
| |plugin.json file|   | |How it looks in the UI|   |
+----------------------+----------------------------+
| |plugin.json file|   | |How it looks in the UI|   |
+----------------------+----------------------------+
| |plugin.json file|   | |How it looks in the UI|   |
+----------------------+----------------------------+

The design supports more complexities such as runtime values for
dropdowns or radio buttons, validations for inputs and even dependencies
between inputs. Navigate to ``/dashboard/developer`` to see actual
examples of all the functionality supported.

.. figure:: screenshots/cm-operations/developer-screen.png
   :alt: Developer screen

   Developer screen