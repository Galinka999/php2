<h2>Карточка товара</h2>
<?php if (is_null($good)): ?>
    <h3>К сожалению данного товара нет.</h3>
<?php else: ?>
        <div>
            <h3><?= $good->title; ?></h3>
            <img class="img-good-big" src="<?= $good->photo ?>">
            <p>Стоимость: <?= $good->price; ?></p>
            <button>Купить</button>
        </div>
<?php endif; ?>