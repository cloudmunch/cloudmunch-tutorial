========
Insights
========

Insights in CloudMunch are categorized as "Cards" & "Key metrics". Both are visual representations of data but differ in intent and visibility. In both cases, the data is stored as JSON ( by a plugin ) in CloudMunch.

Card
----

A card is typically displayed under some category. Today, we support the following types of cards:

- Trend
- Doughnut
- Kanban
- Area Graph

Trend
~~~~~

Example 1
^^^^^^^^^
The JSON

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

Key Metric
----------

Key Metrics are displayed at the top level and are intended to serve as a summary or to highlight important information to users.

.. figure:: screenshots/plugin_simple_insights_example/keymetric.png
    :alt: Key metric
  
    An example of a Key metric

A keymetric always has

- A title ( "Death Toll" )
- A percentage value ( "75%" )
- A caption for the value ( "Number GRRM has killed" )
- A link ( & corresponding title ) to the source of the data ( "Tutorial" )

.. todo::
	Add description for all the nodes in the insight cards