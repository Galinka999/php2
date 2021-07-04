<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
    <?php foreach ($arResult['ITEMS'] as $arItem) :  ?>
<div class="news-list">
        <h1><?= $arItem['NAME'];?></h1>
        <p class="news-item" id="">Название: <?= $arItem['PROPERTIES']['NAME_BOOK']['VALUE']; ?></p>
        <p class="news-item" id="">Автор: <?= $arItem['PROPERTIES']['AUTOR']['VALUE']; ?></p>
    <?php if ($arItem['PROPERTIES']['EXISTENCE']['VALUE'] == '1') : ?>
        <p class="news-item" id="">Стоимость: <?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?></p>
    <?php else : ?>
        <p class="news-item" id="">Данного товара нет в наличии.</p>
    <?php endif; ?>
</div>
    <? endforeach; ?>

