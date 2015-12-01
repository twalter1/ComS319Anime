## Initially created for Reptile Market.  Created by Elliott Butler

## Set up Development Environment (Windows)

### Install PHP

Visit the [PHP for Windows download](http://windows.php.net/download/) website and download the latest build of PHP 5.6+ that is *Non Thread Safe*. 
Either 64 bit or 32 bit will do, but we recommend 64 bit where possible.

After downloading, unzip and move the files to either C:\php ( or C:\Apps\php ) so that php.exe is in the root directory. 

Next rename the php.ini-development file to php.ini and open it. Find and uncomment the following lines:

- extension_dir = "ext"
- extension=php_bz2.dll
- extension=php_curl.dll
- extension=php_fileinfo.dll
- extension=php_gd2.dll
- extension=php_mbstring.dll
- extension=php_openssl.dll
- extension=php_pdo_mysql.dll
    - This will allow local development against a MySQL instance
- extension=php_pdo_sqlite.dll
    - This will allow local development against a SQLite instance

Finally, we must make sure you can access PHP from the command line. To do this, follow the directions located **[here](http://php.net/manual/en/faq.installation.php#faq.installation.addtopath)**.

### Install Composer (Important!)

Visit the [Composer download](https://getcomposer.org/download/) website and download the latest Windows Installer.

After downloading, run the installer and make sure it points to your new install of PHP when prompted.

### Clone this repo

Before you can do any development, you will need to clone this repo either using Git for Windows, TortoiseGit, or Github for Windows.

### Install Dependencies

Open a command prompt in the root directory of your local working copy and run ```composer install```

### PHPStorm

#### Setting up PHPStorm

1. Launch PHPStorm and open the settings found under the file menu.
2. Let's configure our PHP interpreter.
  * Go to Languages & Frameworks and click on PHP. 
  * Under Interpreter, click "..." and add a new entry pointing to your install of PHP.
3. Let's install the Laravel IDE Helper Plugin
  * While still in Settings, go to Plugins and click on Browse Repositories.
  * Search for "Laravel Plugin" and install it.
  * Restart PHPStorm
4. Let's configure Composer.
  * Go to the Tools menu and Click Composer -> Init Composer
  * Browser to or fill in the path to composer.phar you installed earlier.
  * Typically this path is C:\ProgramData\ComposerSetup\bin\composer.phar
5. Let's configure our command line tools
  * Again in settings, go to Tools -> Command Line Tool Support and click the add icon
  * From the drop down, select Tool Based on Symfony Console
  * Type "artisan" in for the alias and search for the artisan file, located in the root of your working copy

#### Importing the project
1. Launch PHPStorm and click open under the file menu.
2. Open the root directory of your local working copy, this will import the project.
3. Open the settings found under the file menu.
4. Go to Other Settings -> Laravel Plugin and check "Enable plugin for this project".

### Eclipse PDT

Coming soon?

### Running Locally

Laravel can be run locally for testing, but does require access to a database such as SQLite. 

To be able to run locally, you'll need to do the following.

1. Create a blank file named database.sqlite within the storage directory. 
2. Copy the .evn.example in the root project directory and name it .env
3. In the command line tools or command line, run ```artisan key:generate```
3. Finally, in the command line tools or command line, run ```artisan migrate:refresh --seed``` to build the tables and seed it with test data.

#### Command line
To run the project locally using your PHP interpreter, simply go to the root directory of your working copy in a command line and run 
```
php artisan serve --port=8080
```

This will run a web-server with the project served at http://localhost:8080/

#### PHPStorm Command Line Tools
To run the project locally using your PHPStorm IDE, open a command line tools instance via PHPStorm's Tools -> Run Commands and then type
```
artisan serve --port=8080
```

This will run a web-server with the project served at http://localhost:8080/

### Troubleshooting

If at any time an issue is introduced by a committ, run the "Fix it.bat" file located in the root directory.
This file will check that all dependencies are installed, the autoload and compiled files are rebuilt, and the database is rebuilt.

### More
