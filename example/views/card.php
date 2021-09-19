<h2>Карточка товара</h2>
<?php if (is_null($good)): ?>
    <h3>К сожалению данного товара нет.</h3>
<?php else: ?>
    <div>
        <h3><?= $good->title; ?></h3>
        <img class="img-good-big" src="<?= $good->photo ?>">
        <p><?=$good->description?></p>
        <p>Стоимость: <?= $good->price; ?></p>
        <button data-id="<?= $good->id; ?>" class="buy">Купить</button>

<!--        <form action="../../basket/add" method="post">-->
<!--            <input type="text" name="id_good" hidden value="--><?//= $good->id ?><!--">-->
<!--            <button type="submit">Купить</button>-->
<!--        </form>-->
    </div>

<?php endif; ?>