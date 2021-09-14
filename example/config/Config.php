<?php
//TODO в идеале завернуть в класс
define('ROOT_DIR', dirname(__DIR__));
//var_dump(ROOT_DIR);
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER_NAMESPACE', 'app\\controllers\\');
define('VIEWS_DIR', '../views/');
define('TEMPLATES_DIR', '../templates/');
define('GOOD_PER_PAGE', 2); //лимит товаров на странице