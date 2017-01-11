Introduction
============

This document will help you learn how to add your own custom functionality to CloudMunch through a step-by-step process.

Intended audience
-----------------

A developer who has :doc:`installed <installation>` and used CloudMunch, and now wants to extend it with custom functionality

Pre-requisites
--------------

-  Basic working knowledge of Docker
-  Working installation of CloudMunch

Our Aim
-------

By the end of this exercise our aim is to fetch data from a google spreadsheet and display some insight in an application.

To achieve our aim, we'll need to configure a task to retrieve data from a

-  Source
-  (in a) Third-party System
-  (which we'll transform into) Insights

Or in "CloudMunch" language, we'll be configuring a `Task which will contain a `plugin` configured to retrieve data from a

-  Resource
-  (in an) Integration
-  (which we'll use to write into a) Report and Card

Please ensure you understand these concepts before you continue with the examples