<?php if ($isAuth) : ?>
<h3>Добро пожаловать, <?= $userName ?>!</h3>
<a href="/auth/logout">[Выход]</a><br><br>
<?php else : ?>
<h3>Войти в личный кабинет:</h3>
<form action="/auth/login" method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="text" name="pass" placeholder="Пароль">
    <input type="submit" name="submit" value="Войти">
</form>
    <br><br><br><br>
<?php endif; ?>


<?php //TODO решить проблему с путями ?>

<a href="/">Главная</a>
<a href="/good/catalog">Каталог</a>
<a href="/gallery/gallery">Галерея</a>
<a href="/basket">Корзина</a>


