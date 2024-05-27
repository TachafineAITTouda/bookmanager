## Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)


## Installation for development
1. Clone the repository
```bash
git clone https://github.com/TachafineAITTouda/bookmanager && cd bookmanager
```

2. Build the project
you can configure the environment variables in the `.env` file or use the default values that are in the `.env..dev.sample` file

```bash
# .env.dev.sample
WWWGROUP=www-data
WWWUSER=www-data
APP_PORT=80
VITE_PORT=5173
PHPMYADMIN_PORT=8081
FORWARD_DB_PORT=3306
SAIL_XDEBUG_MODE=on
PWD=/var/www/html
DB_PASSWORD=password
DB_DATABASE=bookmanager
DB_USERNAME=bookmanager
SAIL_XDEBUG_CONFIG=client_host=host.docker.internal
```
or you can run the following command, that will copy the `.env.dev.sample` file to `.env` file and start the project

```bash
make dev-up
```

3. Install the dependencies

when the project is up and running, you can install the dependencies by logging into the workspace container and running composer install

```bash
make laravel-shell
composer install
```

4. add laravel .env file
you can copy the `.env.example` file to `.env` file and generate the application key
```bash
make laravel-shell
cp .env.example .env
php artisan key:generate
```

5. Run the migrations and seed the database
```bash
make laravel-shell
php artisan migrate --seed
```

## Usage
- we have a live version of the project running on [books.tachafine.com](https://books.tachafine.com)

these are the available functionalities: 
#### Books
- you can view the list of books in the home page
- you can edit and delete a book by clicking on the edit or delete button
- you can add a new book in the form at the top of the page
- you can search for a book and sort them by title or author 
#### Authors
- you can view the list of authors by clicking on the authors link in the sidebar
- you can edit an author by clicking on the edit button
#### export
- you can export the list of books in a csv or xml format and choose the fields you want to export

## Testing

you can run the tests by running the following command
```bash
make laravel-test
```

## Hosting

the project is hosted on a linux server on [books.tachafine.com](https://books.tachafine.com) 
for the deployment, we used the following steps:
- we cloned the repository on the server
- we installed docker and docker compose plugins

1. docker configuration

we have a separate docker-compose file for the production environment, that we use to run the project on the server, it only contains the laravel and mysql services (with different ports than the development environment) since we don't need the other services in production
also we have a separate `.env` file for the production environment.
the current application uses volumes to store the data in the database, so we don't lose the data when the container is stopped.

2. nginx configuration
we have Nginx as a reverse proxy server (directly installed in the server), that listens on port 80 and redirects the requests to the laravel container that listens on port 9005. 

3. SSL configuration
since we are using Cloudflare as a CDN, we have the SSL certificate on the Cloudflare server, 

4. CI/CD

currently, we don't have a CI/CD pipeline, but we can use Github actions to automate the deployment process, by running the tests and deploying the project on the server when the tests pass.

but we have a deployment script that we can run to deploy the project on the server

```bash
/bin/bash bin/deploy_prod.sh
```

