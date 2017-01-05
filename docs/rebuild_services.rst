Rebuild Services
================

Several times in this tutorial you'll need to rebuild CloudMunch containers. To do this, 

- Execute the command `sh customizeCloudMunch.sh` from within CloudMunch installation folder
- And then reset the API's cache using the API `http://192.168.99.100:8000/api/reset` (The `apikey` param is not necessary)

Behind the scenes
-----------------

Within the script, the following operations occur 

- The script first rebuilds the 'executor' service where your plugin will be installed using docker. (The service's dockerfile contains instructions to copy custom plugins into the image and then install them using the install.sh script.)
- All the definitions you've specified need to be copied to the core (the script simply copies the definitions to the shared mount)  
- Since the API may have cached certain responses, clearing the API cache is also necessary

.. image: screenshots/cm-operations/customizeCloudMunch.gif

**Important**: The scripts today assume that the shared folders on the docker host are `/home/docker/platform` and that the docker host is `default`. If either of these assumptions are not true, please edit the scripts before you run them.