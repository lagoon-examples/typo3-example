<?php

/**
 * This file contains Lagoon specific customizations for Typo3.
 *   This can and should be included as the last step in your additional.php file.
 */


if(getenv("LAGOON") !== false) {
    // Set up mariadb connections
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = getenv('MARIADB_DATABASE') ?: 'lagoon';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = getenv('MARIADB_HOST') ?: 'mariadb';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = getenv('MARIADB_PASSWORD') ?: 'lagoon';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = getenv('MARIADB_USER') ?: 'lagoon';
}


