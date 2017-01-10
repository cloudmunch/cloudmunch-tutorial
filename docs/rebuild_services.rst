Rebuild Services
================

Several times in this tutorial you'll need to rebuild CloudMunch containers. To do this, 

- Execute the command ``sh customizeCloudMunch.sh`` from within CloudMunch installation folder

**Important**: The scripts today assume that the shared folders on the docker host are ``/home/docker/platform`` and that the docker host is ``default``. If either of these assumptions are not true, please edit the scripts before you run them.

.. code-block:: bash
	
	$ sh customizeCloudMunch.sh 
	
	Stopping install_executor_1 ... done
	Going to remove install_executor_1
	Removing install_executor_1 ... done
	Building executor
	Step 1 : FROM cmrelease/cloudmunchops-executorservice-dl-hw:test
	 ---> 8a1b56bd4940
	Step 2 : MAINTAINER Cloudmunch
	 ---> Using cache
	 ---> 623049a12430
	Step 3 : ARG CORE_URL
	 ---> Using cache
	 ---> 4477929dcc1c
	Step 4 : RUN echo {\"SERVER\":\"$CORE_URL\"} > /var/cloudbox/_MASTER_/data/contexts/executor/serverconfig.json &&     cd /var/cloudbox/_MASTER_/data/contexts;7za x plugins.7z;rm plugins.7z;cd / &&     rm -rf /cloudmunch-executor &&     chown -R cloudmunch:cloudmunch /var/cloudbox/
	 ---> Using cache
	 ---> 10d35ad8596c
	Step 5 : ADD custom/plugins /tmp/plugins
	 ---> Using cache
	 ---> 98cd46db4ad1
	Step 6 : WORKDIR /tmp/plugins
	 ---> Using cache
	 ---> 9d8f29907861
	Step 7 : RUN sh installPlugins.sh
	 ---> Using cache
	 ---> 7a9229d49fc4
	Step 8 : ENTRYPOINT /bin/bash
	 ---> Using cache
	 ---> cf32a38dae8b
	Step 9 : ADD tomcat.sh /tomcat.sh
	 ---> Using cache
	 ---> c2086f6131ba
	Step 10 : RUN chmod +x /*.sh
	 ---> Using cache
	 ---> 02ad72b2f760
	Step 11 : EXPOSE 8080
	 ---> Using cache
	 ---> d4b61a293e9d
	Step 12 : CMD /tomcat.sh
	 ---> Using cache
	 ---> aba7a9458f4e
	Successfully built aba7a9458f4e
	Creating install_executor_1
	installIntegrations.sh                                                                                                                                                         100%  348   673.0KB/s   00:00    
	README.md                                                                                                                                                                      100%  154   395.8KB/s   00:00    
	installInterfaces.sh                                                                                                                                                           100%  371   963.6KB/s   00:00    
	README.md                                                                                                                                                                      100%  149   389.1KB/s   00:00    
	copyPluginDefinitions.sh                                                                                                                                                       100%  373   917.5KB/s   00:00    
	.DS_Store                                                                                                                                                                      100% 6148     8.4MB/s   00:00    
	composer.json                                                                                                                                                                  100%  207   441.4KB/s   00:00    
	install.sh                                                                                                                                                                     100%  491     1.3MB/s   00:00    
	plugin.json                                                                                                                                                                    100%  600     1.7MB/s   00:00    
	GameOfThrones.class.php                                                                                                                                                        100% 2409     4.6MB/s   00:00    
	installPlugins.sh                                                                                                                                                              100%  589     1.6MB/s   00:00    
	README.md                                                                                                                                                                      100%  140   371.5KB/s   00:00    
	README.md                                                                                                                                                                      100%   98   267.3KB/s   00:00    
	definition.json                                                                                                                                                                100%  536     1.3MB/s   00:00    
	installResources.sh                                                                                                                                                            100%  746     1.5MB/s   00:00    
	README.md                                                                                                                                                                      100%  146   265.5KB/s   00:00    
	wizard-component-template.json                                                                                                                                                 100% 2063     4.2MB/s   00:00    
	
- And then reset the API's cache using the API ``/api/reset`` (The param ``apikey`` is not necessary for this API)
  
.. code-block:: bash

	$ curl http://192.168.99.100:8000/api/reset

	{"data":null,"request":{"request_id":"R2017010611390597102","response_time":"0.02 seconds","status":"SUCCESS"}}

Behind the scenes
-----------------
Within the script, the following operations occur 

- The script first rebuilds the 'executor' service where your plugin will be installed using docker. (*The service's dockerfile contains instructions to copy custom plugins into the image and then install them using the install.sh script*)
- All the definitions you've specified need to be copied to the core (*the script simply copies the definitions to the shared mount*)
- Since the API may have cached certain responses, clearing the API cache is also necessary