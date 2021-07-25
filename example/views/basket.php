<h2>Моя корзина</h2>

<?php if (is_null($basket)): ?>
    <h3>Ваша корзина пуста.</h3>
<?php else: ?>
    <div>
        <? var_dump($basket)?>
    </div>
<?php endif; ?>