========
Insights
========

Insights are simply data represented visually.

In CloudMunch, insights are represented as "Cards" & "Key metrics". Both are still visual representations of data but differ in their intent and visibility. 

Card
----
A card is typically displayed under some category. Today, we support the following types of cards:

=================== ===================
Type                Example
=================== ===================
Line                |trend1|
Doughnut            |doughnut1|
Kanban              |kanban1|
Area Graph          |area1|
=================== =================== 

.. |trend1| image:: screenshots/insights/trend1.png
.. |trend2| image:: screenshots/insights/trend2.png
.. |doughnut1| image:: screenshots/insights/doughnut1.png
.. |kanban1| image:: screenshots/insights/kanban1.png
.. |area1| image:: screenshots/insights/area1.png

All cards are internally stored as JSONs. Below are a few examples of the JSONs and their corresponding cards

Line
~~~~

.. literalinclude:: screenshots/insights/trend1.json
    :language: json

produces

.. figure:: screenshots/insights/trend1.png
    :alt: Trend
    :align: center


Example 2
^^^^^^^^^
The JSON

.. literalinclude:: screenshots/insights/trend2.json
	:language: json

produces

.. figure:: screenshots/insights/trend2.png
    :alt: Trend
    :align: center

Doughnut
~~~~~~~~

The JSON

.. literalinclude:: screenshots/insights/doughnut1.json
	:language: json

produces

.. figure:: screenshots/insights/doughnut1.png
    :alt: Doughnut Example
    :align: center

Kanban
~~~~~~

The JSON

.. literalinclude:: screenshots/insights/kanban1.json
	:language: json

produces

.. figure:: screenshots/insights/kanban1.png
    :alt: Kanban Example
    :align: center

Area Graph
~~~~~~~~~~

The JSON

.. literalinclude:: screenshots/insights/area1.json
	:language: json

produces

.. figure:: screenshots/insights/area1.png
    :alt: Area example
    :align: center

Code
^^^^
SDKs contain utility methods to store the data necessary for each card. For instance, in PHP, to store the data necessary for a Doughnut card, you'd use

.. code-block:: php

	$reportID = $this->cmInsightsHelper->createDoughnutGraph($resourceID, $data, 
	"LannistersReport", "Lannisters Report", "Tutorial", "Death toll", $source,
	$sourceURL, json_decode('["alive(4)","dead(1)"]') );

Please refer to the :ref:`refSDKs` for more information and examples.

Key Metric
----------
Key Metrics are displayed at the top level and are intended to serve as a summary or to highlight important information to users.

.. figure:: screenshots/plugin_simple_insights_example/keymetric.png
    :alt: Key metric
  
    An example of a Key metric

A keymetric always has

- A title ( "Death Toll" )
- A value which can be a percentage ( "75%" ) or simply a number ("24")
- A subtitle for the value ( "Number GRRM has killed" )
- A link ( & corresponding title ) to the source of the data ( "Tutorial" )
- A time stamp as to when this was created. Please note that the "Value" itself may be old, but it was pulled into CloudMunch as per the time stamp.

.. todo::
	Add description for all the nodes in the insight cards
.. todo::
    Add plugin method to invoke for each card
