<h2>Каталог</h2>
<?php //var_dump($catalog) ?>
<?php if (is_null($catalog)): ?>
    <h3>К сожалению доступных товаров нет.</h3>
<?php else: ?>
<div class="flex flex-wrap" id="catalog">
    <?php foreach ($catalog as $item): ?>
        <div class="good-big vvv">
            <a class="photo"  href="../good/card/?id=<?= $item['id']?>">
                <h3><?= $item['title']?></h3>
            </a>
            <img class="img-good" src="<?= $item['photo'] ?>">
            <p>Стоимость: <?= $item['price']?></p>
            <button>Купить</button>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<br><br>

<button id="showmore-btn" data-page="<?= $page ?>" data-max="<?= $count ?>">Еще</button>








