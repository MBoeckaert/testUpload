# Goal
The goal of this repo is to setup a local server for PHP development, in combination with MySQL. We'll be using [Docker](https://www.docker.com/ "Dockers Homepage") for this.
This repo also supports the use of Webpack

# Installation
## Docker
* Download Docker at https://download.docker.com/mac/stable/Docker.dmg
* Open the dmg file en follow the instructions to install Docker on your machine.

## Development 3 server installation
With Docker you can set up different "containers" to run specific stacks on your machine.
* Download this project at https://github.com/devinekask/webpack-php-template/archive/main.zip
* Extract the zip file into the folder where you want to keep all your files for this course
* Right click on the `start` file and choose `open`. You might get a notification the file isn't from the App Store. You may ignore this and open the file.
* Your Terminal should open and execute a few commands. The very first time this might take a couple of minutes to complete.
* Note: this will also install the illuminate/database extension

## Development 3 server usage
Once the server is running (using the start script), you can use the server as follows:
* Open your browser and navigate to http://localhost.  You should see an overview of your PHP installation.
* All files and folders inside of the [www/html](www/html) folder are accessible through http://localhost
* You can access phpMyAdmin through http://localhost
* You can shut down the server by opening the `stop` script.

## Development 3 Webpack usage
This template also contains a prepared webpack configuration.
* All files for a project can be found in [www/html/php-template-project](www/html/php-template-project). 
* Check the config file and note that the dev server runs on port 3000 and HTML rendering is in comments
* Check Controller.php: it checks if the project runs in production or development mode and loads the corresponding files

## Deployment to Heroku
### Depolyment with Git
Create a new app in Heroku and connect your GitHub repository. Do not forget to install the PHP buildpack in the settings.

NOTE: Make sure you set a config variable `PHP_AUTOLOAD_PATH` in your heroko project with the value `../vendor/autoload.php`

### Deployment with the command line
Make sure you have installed the Heroku CLI. This is done on MacOS by using Homebrew. So, you need to install Homebrew first. Once it is installed you can install the Heroku CLI by executing the following command: `brew tap heroku/brew && brew install heroku``

You can use the script deploy-heroku to deploy your project. This script can be executed in the terminal and requires 2 parameters:
1. path to the folder of your project 
2. name of your project in Heroku

For example: `./deploy-heroku ./www/html/php-template-project name-of-heroku-project`

NOTE: Make sure you set a config variable `PHP_AUTOLOAD_PATH` in your heroko project with the value `./vendor/autoload.php`