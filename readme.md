## LaraBrain

LaraBrain is a community-driven learning resource for publishing and sharing Laravel tips and tricks. The LaraBrain source code is also sold through EasyPHPWebApps.com as a learning resource for developers interested in learning how a Laravel-driven site of this nature is constructed.

### Installing the LaraBrain

To run LaraBrain locally you'll need a recent version of PHP (5.5.9 or newer), Composer, Laravel 5.1 or newer, and a database (MySQL, PostgreSQL, and MS SQL Server are supported). 

#### Install the Composer Packages

Enter the project directory and execute the following command:

	$ composer install

#### Creating the Database

Laravel supports MySQL, PostgreSQL, SQLite, and MS SQL Server. I tend to use the naming convention `dev_DOMAINNAME_com` for my local development databases, therefore for the LaraBrain project I created a database named `dev_larabrain_com`.

If you want to use SQLite you'll first need to create an "empty" database. This is done by creating an empty file named `database.sqlite` inside the `storage` directory:

	$ touch storage/database.sqlite

#### Update the .env Configuration File

Next, you'll want to update the `.env` file to suit your local database connection parameters. You'll need to change the following variables:

	DB_CONNECTION
	DB_HOST
	DB_DATABASE
	DB_USERNAME
	DB_PASSWORD

I use MySQL for most projects, and so my `DB_CONNECTION` variable is set to `mysql`. However you're free to use PostgreSQL, SQLite, and MS SQL Server; just set `DB_CONNECTION` to `pgsql`, `sqlite`, or `sqlsrv`, respectively.

#### Run the Migrations

The LaraBrain application relies on several database tables for managing information such as user accounts, tips, and categories. These tables were created and modified using Laravel migrations. To install the tables inside your local database run the following command:

	$ php artisan migrate

#### Seed the Database

You can optionally install some sample data, including example categories, tips, and an administrator account. This sample data is managed within seed files (`database/seeds`). To load the seed data into your local database, run the following command:

	$ php artisan db:seed

#### Start the PHP Web Server

If you're using Homestead then you should now be able to access the local site per usual. Otherwise you can use PHP's built-in web server by running the following command from the project root directory:

	$ php artisan serve

#### Running the Tests

The LaraBrain source code includes several tests. You can run them by executing the following command:

	$ phpunit

### Support

LaraBrain creator W. Jason Gilmore is always happy to answer questions. E-mail support@larabrain.com with your questions, comments, and suggestions. Jason is also available for custom development work and longer consulting engagements.

### License

Purchasers of the LaraBrain source code are free to use the code for personal, educational, and commercial purposes, however may *not* publish or distribute the source code without written permission from WJ Gilmore, LLC. You may not use the LaraBrain name or logo in any manner. Questions? E-mail us at support@wjgilmore.com.

