<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class="news-list">
    <?php foreach ($arResult['ITEMS'] as $arItem) :  ?>
        <?php var_dump($arResult['ITEMS']);?>
    <p class="news-item" id="">
        Добpo пожаловать: <a href="<?php $arItem['PROPERTIES']['LINK']['VALUE'] ?>">
            <?= $arItem['NAME'] ?>(<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>)</a>
    </p>
    <?php endforeach; ?>
</div>


