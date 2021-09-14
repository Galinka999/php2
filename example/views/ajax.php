<?php
foreach ($catalog as $item): ?>
        <div class="good-big vvv">
            <a class="photo"  href="../good/card/?id=<?= $item['id']?>">
                <h3><?= $item['title']?></h3>
            </a>
            <img class="img-good" src="<?= $item['photo'] ?>">
            <p>Стоимость: <?= $item['price']?></p>
            <button>Купить</button>
        </div>
<?php endforeach; ?>
