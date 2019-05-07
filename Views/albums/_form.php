<?php ?>


<div class="form-group">
    <label>Обложка</label>
    <input type="file" class="form-control" name="cover" value="<?php echo $album['cover'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Название</label>
    <input type="text " class="form-control" name="title" value="<?php echo $album['title'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Имя исполнителя</label>
    <input type="text" class="form-control" name="artist_name" value="<?php echo $album['artist_name'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Год</label>
    <input type="text" class="form-control" name="release_year" value="<?php echo $album['release_year'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Длительность</label>
    <input type="text" class="form-control" name="duration" value="<?php echo $album['duration'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Стоимость</label>
    <input type="text" class="form-control" name="price" value="<?php echo $album['price'] ?? null ?>" />
</div>

<div class="form-group">
    <label>Код хранилища</label>
    <input type="text" class="form-control" name="warehouse_code" value="<?php echo $album['warehouse_code'] ?? null ?>" />
</div>

