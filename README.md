# TYPO3 CMS on Lagoon

This Repo gives a simple example of how you can get Typo3 running on Lagoon.

This README assumes that you are already familiar with Typo3, and will work to point out the differences/requirements when running on Lagoon.

## Included services

This example contains the following services:
* Typo3
* PHP 8.3
* NGINX
* MySQL 8.0

## Important files
* `./.lagoon.yml` - This file contains the configuration needed to make the local docker compose stack work in Lagoon

## Settings

In this example we're assuming we're running with a MySQL database.
As such, if you look in the `config/system/additional.php` and `config/system/lagoon.additional.php` files you'll note that we dynamically set the MySQL details.

## Workflows

The following guides assume a "develop local, push to production" strategy.

### Setup with Docker Compose

To build the containers, run the docker commands below to get a running local stack with a local install of typo3.

```
docker compose build
docker compose up -d
docker compose exec cli bash -c "composer install"
docker compose exec cli bash -c "typo3 setup"
```
Note that the database credentials are prepopulated via variables to avoid any complications in configuring them.

### Setup with DDEV

In order to utilise the [DDEV Lagoon provider](https://ddev.readthedocs.io/en/stable/users/providers/lagoon/) for local development run the DDEV commands below to get a running local stack with a local install of typo3.

```
ddev start
ddev exec "composer install"
ddev exec "typo3 setup"
```
Note that the database credentials are prepopulated via variables to avoid any complications in configuring them.

## Workflows - site config

Once the above steps have been completed, note that there will be changes to the settings.php file - these are storing the database configuration (usually overridden by lagoon.additional.php) and any admin user config.

You should commit these changes to git, as this config will be used to build your site in Lagoon.

## Workflows - pushing config/content to Lagoon

The git config will trigger a build in Lagoon, assuming your project has been correctly configured - this site will have an empty database, and the admin user configured in settings.php, but you will not be able to log in to it yet.

### Pushing your local DB to Lagoon - Docker Compose

In order to get your local site database (config, pages etc) and files (images, documents, uploads etc) to the Lagoon site, you will need to synchronise the content. These commands will sync the database and files from "local" to the specified environment in Lagoon.

Note that you'll need SSH access running in the containers, either via [pygmy](https://www.github.com/pygmystack) or another Docker Compose method.
```
docker compose exec cli bash
lagoon-sync sync mariadb -p {project-name} -t {environment-name} -e local
lagoon-sync sync files -p {project-name} -t {environment-name} -e local
```

### Pushing your local DB to Lagoon - DDEV

In order to get your local site database (config, pages etc) and files (images, documents, uploads etc) to the Lagoon site, you will need to synchronise the content. These commands will sync the database and files from "local" to the specified environment in Lagoon.

```
ddev auth ssh
ddev push lagoon
```

## Workflows - pulling config/content to Lagoon

In order to synchronise your local database/files with the Lagoon site, you will need to perform "pulls"

To do this, either in Docker Compose or DDEV, perform the following.
```
docker compose exec cli bash
lagoon-sync sync mariadb -p {project-name} -e {environment-name} -t local
lagoon-sync sync files -p {project-name} -e {environment-name} -t local
```
or
```
ddev auth ssh
ddev pull lagoon
```

## Workflows - extensions/modules

To install modules using Composer, perform the following

```
docker compose exec cli bash -c "composer require {typo3_package}:{version}"
```
or
```
ddev composer require "{typo3_package}:{version}"
```
Note that this will update the composer.json and composer.lock files in your repo. You will need to Git commit and push them up to Lagoon prior to being able to use them.
