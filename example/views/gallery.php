<h2>Галерея</h2>

<div class="flex flex-wrap">
    <?php if($gallery) : ?>
        <?php foreach ($gallery as $value): ?>
        <div class="gallery">
            <a class="photo" href="../?c=gallery&a=galleryOne&id=<?= $value['id']?>">
                <img class="gallery_item" src="/images/big/<?= $value['filename']?>"/>
            </a>
        </div>
        <?php endforeach;?>
    <?php endif; ?>
</div>

