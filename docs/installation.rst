=======================
CloudMunch Installation
=======================

This document explains how to install and setup CloudMunch locally.

Infrastructure Requirements
---------------------------
- OS: RedHat 7 or Debian 7
- Diskspace: ~200 GB
- RAM: Minimum of 8 GB
- CPU: Minium Dual core
- Docker
- Docker Compose
- Internet access (please ensure that there is connectivity to GitHub, S3, Docker Hub, Google Fonts & yum access for mod_ssl)

Pre-requisites
--------------
Basic understanding of containers, images & docker-compose are required to complete the steps below.

Installation
------------

Interactive Installation Script (Supports Centos 7 and Redhat 7)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

- Make sure the user you are trying to install with has sudo permissions
- Install git 

.. code:: bash

    sudo yum install git-all

* Clone CloudMunch Install repo

.. code:: bash
	git clone https://github.com/cloudmunch/Install.git

* If you want to run CloudMunch on SSL (https), please follow instructions from [here](https://github.com/cloudmunch/Install#ssl-setup-optional)
* Navigate within Install directory and execute install script
```
sh ./install.sh
```

Mac OS
~~~~~~

Docker For Mac
^^^^^^^^^^^^^^
- Search for VirtualBox uninstall and run the uninstall tool
- Uninstall boot2docker
- Uninstall docker machine if you have it running
- Download docker for Mac or Windows from the Docker_ website and install Docker 1.12

Linux
~~~~~
- Install Docker `sudo yum install docker`
- Add user to Docker group `sudo usermod -aG docker <your_username>`. If docker group does not exist, create one using `sudo groupadd docker` and then retry
- Logout and login again
- Start Docker as service `sudo service docker start`

docker-compose
~~~~~~~~~~~~~~
- Change to root and install docker-compose from any stable `release <https://github.com/docker/compose/releases/>`_
- Make docker-compose executable `chmod +x /usr/local/bin/docker-compose`
  
Setup
-----
- Create a user and group with name `cloudmunch` and id `580`
- Ensure command line git is installed `sudo yum install git-all`
- Create volumes `/home/docker/platform` and `/home/docker/domain` to share container data.
- Update the owner of these two folders to cloudmunch `chown -R cloudmunch:cloudmunch /home/docker/domain/ /home/docker/platform/`

.. code:: bash

	docker-machine ssh default
	                        ##         .
	                  ## ## ##        ==
	               ## ## ## ## ##    ===
	           /"""""""""""""""""\___/ ===
	      ~~~ {~~ ~~~~ ~~~ ~~~~ ~~~ ~ /  ===- ~~~
	           \______ o           __/
	             \    \         __/
	              \____\_______/
	 _                 _   ____     _            _
	| |__   ___   ___ | |_|___ \ __| | ___   ___| | _____ _ __
	| '_ \ / _ \ / _ \| __| __) / _` |/ _ \ / __| |/ / _ \ '__|
	| |_) | (_) | (_) | |_ / __/ (_| | (_) | (__|   <  __/ |
	|_.__/ \___/ \___/ \__|_____\__,_|\___/ \___|_|\_\___|_|
	Boot2Docker version 1.12.0, build HEAD : e030bab - Fri Jul 29 00:29:14 UTC 2016
	Docker version 1.12.0, build 8eab29e
	docker@default:~$ sudo su
	root@default:/home/docker# pwd
	/home/docker
	root@default:/home/docker# mkdir domain;mkdir platform
	root@default:/home/docker# sudo adduser -u 580 -g cloudmunch cloudmunch
	Changing password for cloudmunch
	New password: 
	Retype password: 
	Password for cloudmunch changed by root
	root@default:/home/docker# sudo chown -R cloudmunch:cloudmunch domain;sudo chown -R cloudmunch:cloudmunch platform
	root@default:/home/docker# curl -L https://github.com/docker/compose/releases/download/1.9.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
	  % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
	                                 Dload  Upload   Total   Spent    Left  Speed
	100   600    0   600    0     0    534      0 --:--:--  0:00:01 --:--:--   534
	100 7857k  100 7857k    0     0   263k      0  0:00:29  0:00:29 --:--:--  499k
	root@default:/home/docker# chmod +x /usr/local/bin/docker-compose


- If you are in the docker-machine, exit and get back to your bash prompt
- Download the CloudMunch Installation repo

.. code:: bash

	mkdir cloudmunch
	cd cloudmunch
	git clone https://github.com/cloudmunch/Install.git

- Open the file `docker-compose.yml` in an editor and modify all occurrences of `127.0.0.1` to your docker-machine's IP address
- Correct the paths of the volumes as per your installation
- Login to docker hub using `docker login`
- Bring up the containers using docker-compose `docker-compose up -d`
- The application should now be available at `http://<docker-mahine ip>/dashboard/login`

.. _Docker: http://www.docker.com/products/overview
