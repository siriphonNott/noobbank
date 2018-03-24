<?php

// SET ENVIRONMENT
define("DB_NAME", "bank");
if ($_SERVER['HTTP_HOST'] == "noobbank-nottdev.com") { // DEV
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
} else { //PRODUCTION
    define("DB_USERNAME", "app_user");
    define("DB_PASSWORD", "@app2018");
}
