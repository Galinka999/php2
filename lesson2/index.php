<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->includeComponent(
    'ylab:element.list',
    'grid',
);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
