<?php

date_default_timezone_set("America/Fortaleza");
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
set_time_limit(60);

session_start([
    "name" => "app_contas"
]);

define("URL_BASE", "http://localhost/projeto-continhas");

define("DB_HOST", "localhost");
define("DB_NAME", "app_contas");
define("DB_USER", "root");
define("DB_PASS", "");
