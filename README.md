# TYPO3 CMS on Lagoon

This Repo gives a simple example of how you can get Typo3 running on Lagoon.

This README assumes that you are already familiar with Typo3, and will work to point out the differences/requirements when running on Lagoon.

## Included services

This example contains the following services:
* Typo3
* PHP 8.3
* NGINX
* MariaDB 10.11

## Important files
* `./.lagoon.yml` 

## Settings

In this example we're assuming we're running with a Mariadb database.
As such, if you look in the `config/system/additional.php` and `config/system/lagoon.additional.php` files you'll note that we dynamically set
the Mariadb details.

Furthermore, you'll notice that 