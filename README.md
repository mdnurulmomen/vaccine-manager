# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

*__Disclaimer:__ You may need sudo access to perform the following commands*/

Clone the repository

```
    git clone https://github.com/mdnurulmomen/vaccine-manager.git
```

Switch to the repo folder

```
    cd vaccine-manager
```

Install all the dependencies using composer

```
    composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
    cp .env.example .env
```

*Update APP_NAME, QUEUE & MAIL creadentials at .env*

Example .env

```
APP_NAME=Kahf
...
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=b5d771d31fd249
MAIL_PASSWORD=828727c30c1eb1
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@${APP_NAME}.com"
MAIL_FROM_NAME="${APP_NAME}"
...
QUEUE_CONNECTION=database
```

Generate a new application key

```
    php artisan key:generate
```

Run the database migrations and seeder

**N.B.**: *Set the database connection & credentials mentioned in `.env` before migrating*

```
    php artisan migrate
    php artisan db:seed
```

Install *node* dependencis

```
npm install
```

After installation, build with *npm*

```
npm run dev
```

*Please open another terminal or tab on terminal*

And Run the application locally

```
php artisan serve
```

Now, run each following command at separate terminal/tab to make the notifications operational.

**N.B.** *You should test the notifications at 9 PM or change the setting at `app/Console/Kernel.php` file.

```
php artisan schedule:work
```

```
php artisan queue:work
```

*All set ! Now you should be able to browse `http://localhost:8000/`* or `http://127.0.0.1:8000`

***Note*** : *To get started quickly, please start with login button. Sample Admin username and password should already been generated with previous steps.*

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/Api/V1` - Contains all the api controllers
- `app/Http/Requests/Api` - Contains all the api form requests
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeders` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file
