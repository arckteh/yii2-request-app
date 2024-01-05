<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Requests management app based on Yii 2 Basic Project Template</h1>
    <br>
    For original template  check <a href="https://github.com/yiisoft" target="_blank">Yii 2 Basic Project
            </a>
</p>

The project implements a system for accepting and processing user requests from the site

INSTALLATION
------------

Clone repository to your web server root

~~~
git clone git@github.com:arckteh/yii2-request-app app
~~~

### Install on  an existing server

If tou already have web server with composer installed and configured run project initialization:

    composer create-project


Adjust the configuration:
set cookie validation key in _config/web.php_

~~~
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
~~~

Adjust database settings in config files  

    config/db.php  
    config/test_db.php

Now you can init databases with composer command
~~~
composer init-db
~~~

Access the application through the following URL

~~~
http://localhost/basic/web/
~~~

### Install web server with Docker

Copy _.env_template_ to the _.env_.
If you want, change docker settings in the .env file

Start the container

    docker compose up -d

Run project installation
    
    docker compose run --rm php composer create-project

Adjust settings:
Set cookie validation key in config/web.php and database configuration in _config/db.php_ and _config/test_db.php_.
Run database initialization 
    
    docker compose run --rm php composer init-db   
    
You can then access the application through the following URL:

    http://loclhost

To stop and remove the container  use command

    docker compose  down

TESTING
-------

To run all tests use the command:

    vendor/bin/codecept run

And you can run the api tests with the command

    vendor/bin/codecept run api