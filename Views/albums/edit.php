<?php ?>


<form class="form mt-5 col-6" method="post" action="/album/update?id=<?php echo $album['id'] ?>" enctype="multipart/form-data">
    <h2>#<?php echo $album['id'] ?> <?php echo $album['title'] ?></h2>
    <?php require "_form.php" ?>
    <button type="submit" class="btn btn-success">
        <span>Сохранить</span>
    </button>
</form>