<?php

/**
 * This is a _very_ basic additional.php file
 * see: https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/Configuration/Typo3ConfVars/Index.html#file-config-system-additional-php
 *
 * Essentially, it's a stand in for your own additional.php. If you're running on Lagoon, you should add the include_once below
 *   this will key in your Typo3 installation to the Lagoon installation it's running on
 *
 */


// No matter what your additional.php does above, if you're running on Lagoon, ensure that you ...
include_once(__DIR__ . "/lagoon.additional.php");