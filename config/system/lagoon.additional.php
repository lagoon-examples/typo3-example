<?php

/**
 * This file contains Lagoon specific customizations for Typo3.
 *   This can and should be included as the last step in your additional.php file.
 */

if(getenv("LAGOON") !== false) {
    // Set up mariadb connections
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['driver'] = 'mysqli';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = getenv('DATABASE_HOST') ?: 'database';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['port'] = getenv('DATABASE_PORT') ?: '3306';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = getenv('DATABASE_DATABASE') ?: 'lagoon';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = getenv('DATABASE_USERNAME') ?: 'lagoon';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = getenv('DATABASE_PASSWORD') ?: 'lagoon';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['charset'] = getenv('DATABASE_CHARSET') ?: 'utf8mb4';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['tableoptions']['charset'] = getenv('DATABASE_CHARSET') ?: 'utf8mb4';
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['tableoptions']['collate'] = getenv('DATABASE_COLLATION') ?: 'utf8mb4_general_ci';

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = 'noreply@lagoon.sh';
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = '1';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = '1';

    if(getenv("LAGOON_ENVIRONMENT_TYPE") == "production") {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '0';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '0';
        $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = '0';
        $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = '0';
    }

    // We have lagoon logs installed - let's use it.

    if(class_exists('Uselagoon\Typo3LagoonLogs\Typo3LagoonLogsWriter')) {
        $GLOBALS['TYPO3_CONF_VARS']['LOG'] = [
            'writerConfiguration' => [
                'warning' => [
                    'Uselagoon\Typo3LagoonLogs\Typo3LagoonLogsWriter' => [
                        'disabled' => false,
                    ],
                ],
                'error' => [
                    'Uselagoon\Typo3LagoonLogs\Typo3LagoonLogsWriter' => [
                        'disabled' => false,
                    ],
                ],
                'info' => [
                    'Uselagoon\Typo3LagoonLogs\Typo3LagoonLogsWriter' => [
                        'disabled' => false,
                    ],
                ],
                'notice' => [
                    'Uselagoon\Typo3LagoonLogs\Typo3LagoonLogsWriter' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ];
    }
}


