
<?php if (is_null($galleryOne)): ?>
    <h2>Что-то пошло не так.</h2>
<?php else: ?>
        <div>
            <h2>Одна картинка</h2>
            <img class="img-good-big" src="/images/big/<?= $galleryOne->filename ?>">
            <p>Likes: <?= $galleryOne->likes ?></p>
        </div>
<?php endif; ?>
<div>
    <button>
        <a href="/?c=gallery&a=gallery">
            Назад
        </a>
    </button>
</div>




