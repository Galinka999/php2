<h2>Каталог</h2>

<?php if (is_null($catalog)): ?>
    <h3>К сожалению доступных товаров нет.</h3>
<?php else: ?>
<div class="flex flex-wrap" id="catalog">
    <?php foreach ($catalog as $item): ?>
        <div class="good-big vvv" id="vvv">
            <a class="photo"  href="../good/card/?id=<?= $item['id']?>">
                <h3><?= $item['title']?></h3>
            </a>
            <img class="img-good" src="<?= $item['photo'] ?>">
            <p>Стоимость: <?= $item['price']?></p>
            <button data-id="<?= $item['id']?>" onclick="buy(<?= $item['id']?>)" class="buy">Купить</button>

<!--            <form action="/basket/add" method="post">-->
<!--                <input type="text" name="id_good" hidden value="--><?//= $item['id'] ?><!--">-->
<!--                <button type="submit">Купить</button>-->
<!--            </form>-->

        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<br><br>

<button id="showmore-btn" data-page="1" data-max="<?= $count ?>">Еще</button>






