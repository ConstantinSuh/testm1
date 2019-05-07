<?php ?>


<form class="mt-5" method="get" action="/">


    <h3>Фильтры</h3>
    <table class="table table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Артист</th>
            <th>Год</th>
            <th>Длительность</th>
            <th>Стоимость</th>
            <th>Код склада</th>
        </tr>
        <tr>
            <th>
                <input class="form-control" name="filter[id]" value="<?php echo $_GET['filter']['id'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[title]" value="<?php echo $_GET['filter']['title'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[artist_name]"
                       value="<?php echo $_GET['filter']['artist_name'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[release_year]"
                       value="<?php echo $_GET['filter']['release_year'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[duration]"
                       value="<?php echo $_GET['filter']['duration'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[price]" value="<?php echo $_GET['filter']['price'] ?? '' ?>">
            </th>
            <th>
                <input class="form-control" name="filter[warehouse_code]"
                       value="<?php echo $_GET['filter']['warehouse_code'] ?? '' ?>">
            </th>
        </tr>

        <tr>
            <th>
                <select class="form-control" name="sort[id]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[title]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[artist_name]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[release_year]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[duration]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[price]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
            <th>
                <select class="form-control" name="sort[warehouse_code]">
                    <option value=""></option>
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </th>
        </tr>
        <tr>
            <th colspan="100">
                <button type="submit" class="btn btn-success">
                    <span>Применить</span>
                </button>
                <a href="/" class="btn btn-warning" form="form-clear">
                    <span>Сбросить</span>
                </a>
            </th>
        </tr>

        </thead>

    </table>
</form>

<table class="table table-sm">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Артист</th>
        <th>Год</th>
        <th>Длительность</th>
        <th>Стоимость</th>
        <th>Код склада</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($albums as $album) : ?>
        <tr>
            <td><a href="/album/edit?id=<?php echo $album['id'] ?>"><?php echo $album['id'] ?></a></td>
            <td><img alt="" height="30" src="<?php echo $filepath . DIRECTORY_SEPARATOR . $album['cover'] ?>" ></td>
            <td><?php echo $album['title'] ?></td>
            <td><?php echo $album['artist_name'] ?></td>
            <td><?php echo $album['release_year'] ?></td>
            <td><?php echo $album['duration'] ?></td>
            <td><?php echo $album['price'] ?></td>
            <td><?php echo $album['warehouse_code'] ?></td>
            <td>
                <form method="post" action="/album/delete?id=<?php echo $album['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <span>X</span>
                    </button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>

    <tfoot>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Артист</th>
        <th>Год</th>
        <th>Длительность</th>
        <th>Стоимость</th>
        <th>Код склада</th>
        <th>Удалить</th>
    </tr>
    </tfoot>
</table>


<a href="/album/create" class="btn btn-primary">Создать</a>
