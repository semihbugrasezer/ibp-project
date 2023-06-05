# ibp-proje

youtube link: 

Once you are inside the project directory, run the following command to install the project dependencies using Composer:
```
composer update 
composer install
```
Configure Environment
```
cp .env.example .env
```
Next, open the `.env` file in a text editor and update the database and other configuration details as per your local environment.

Generate an Application Key
While still inside the project directory and in the terminal, run the following command to generate an application key for your Laravel project:
```
php artisan key:generate
```
Run the Project
Once the dependencies are installed and the environment is configured, you can run the Laravel project by executing the following command:
```
php artisan serve
```
