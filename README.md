
# Thiio App

This project is a basic example of a web application made with VueJS as the main framework and Vuetify for the styles. In it you can do some basic operations such as **register**, **login** and **logout**.

The following security measures are taken into account within the application:
* Authentication with JWT
* Safe paths
* Unexposed data

The main framework to use was Laravel, in which the REST API was created to consume from the FrontEnd, authentication modules, password validation, user consultation and as an extra, email validation by tokens were created.


## Installation

In order to install the application it will be necessary to clone the repository, there was no use of branches so it is enough to use the main branch.

To do this you will need to have composer installed to be able to use the following commands within our project

```bash
  composer install
  npm install
```

MySQL was used for this project but you can feel free to use any database you want. In it you need create a database called **_thiio_app_**

In your env file you configure the database

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=thiio_app
DB_USERNAME=root
DB_PASSWORD=1234
```

To generate a new APP_KEY with JWT you need to run the following command

```bash
php artisan jwt:generate
```

Finally you only need to migrate the database

```bash
php artisan migrate
```

Now to run the app you need two terminal sessions. In one terminal you run the backend and the other the frontend

```bash
php artisan serve
```

```bash
npm run dev
```

With these settings you should be able to use the thiio application.

Thank you so much :)
