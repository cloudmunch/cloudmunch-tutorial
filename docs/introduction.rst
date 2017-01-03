Introduction
============

This document will help you learn how to add your own custom functionality to CloudMunch through a step-by-step process.

Intended audience
-----------------

A developer who has `installed CloudMunch locally <https://github.com/cloudmunch/Install>`__ and now wants to extend it with his (or her) own functionality

Pre-requisites
--------------

-  Basic working knowledge of Docker

Our Aim
-------

By the end of this exercise our aim is to fetch data from a google spreadsheet and display some insight in an application.

To achieve our aim, we'll need to configure a task to retrieve data from a

-  Source
-  (in a) Third-party System
-  (which we'll transform into) Insights

Or in "CloudMunch" language, we'll be configuring a ``Task`` which will contain a ``plugin`` configured to retrieve data from a

-  Resource
-  (in an) Integration
-  (which we'll use to write into a) Report and Card

From the end-user's perspective, Insights in CloudMunch are grouped under Resources 

- A Resource is added to an application through the many wizards available
- Each Resource is associated with an third-party system (an Integration)
- so the wizard prompts the user to add the integration for a resource
- Once a Resource has been added and configured with inputs, the wizard triggers an Insight Task
- This task contains several plugins. Each plugin is associated with one type of resource and it
- Gets the list of resources for that type. And for each resource
	- Gets the corresponding integration 
	- Access the integration through its interface
	- Fetches the resource data 
	- Transforms and stores the data into the Resource's Datastore as Extracts ( NOTE: This is optional and is done to allow for optimizations & incremental fetches in the future) - Transforms and stores the data as a report (which are later rendered in the UI as cards)
	- Collects key metrics from the data and displays them as highlights (Optional)