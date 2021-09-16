<h2>Моя корзина</h2>
<?php if (is_null($basket)): ?>
    <h3>Ваша корзина пуста.</h3>
<?php else: ?>
    <div class="flex flex-wrap" id="catalog">
        <?php foreach ($basket as $item): ?>
            <div class="good-big vvv">
                <a class="photo"  href="../good/card/?id=<?= $item['good_id']?>">
                    <h3><?= $item['title']?></h3>
                </a>
                <img class="img-good" src="<?= $item['photo'] ?>">
                <p>Стоимость: <?= $item['price']?></p>
                <form action="/basket/delete" method="post">
                    <input type="text" name="id_good" hidden value="<?= $item['good_id'] ?>">
                    <button type="submit">Удалить</button>
                </form>

            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>