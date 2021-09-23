<h2>Моя корзина</h2>
<?php if (!empty($basket)): ?>
    <div class="flex flex-wrap" id="catalog">
        <?php foreach ($basket as $item): ?>
            <div class="good-big vvv" id="<?= $item['basket_id']?>">
                <a class="photo"  href="../good/card/?id=<?= $item['good_id']?>">
                    <h3><?= $item['title']?></h3>
                </a>
                <img class="img-good" src="<?= $item['photo'] ?>">
                <p>Стоимость: <?= $item['price']?></p>
                 <button onclick="deleteFromBasket(<?= $item['basket_id']?>)" class="delete">Удалить</button>

<!--                <form action="/basket/delete" method="post">-->
<!--                    <input type="text" name="basket_id" hidden value="--><?//= $item['basket_id'] ?><!--">-->
<!--                    <button type="submit">Удалить</button>-->
<!--                </form>-->
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
        <h3>Ваша корзина пуста.</h3>
<?php endif; ?>