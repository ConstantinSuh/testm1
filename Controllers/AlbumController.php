<?php

namespace Controllers;

use Components\App;
use Components\FileManager;
use Models\AlbumModel;

class AlbumController extends BaseController
{

    public function actionIndex()
    {
        $albums = (new AlbumModel())->search($_GET);

        $this->render('albums/index', [
            'albums' => $albums,
            'filepath' => App::app()->config['filepath']
        ]);
    }

    public function actionEdit()
    {
        $album = AlbumModel::builder()
            ->where('id', $_GET['id'])
            ->fetch()[0];

        $this->render('albums/edit', [
            'album' => $album
        ]);
    }

    public function actionCreate()
    {
        $this->render('albums/create');
    }

    public function actionStore()
    {
        $data = $_POST;
        if (!empty($_FILES['cover']['tmp_name']) && getimagesize($_FILES["cover"]["tmp_name"])) {
            $data['cover'] = FileManager::upload($_FILES['cover']);
        }

        if ($this->validateData($data)) {
            AlbumModel::insert($data);
            header('Location: /');
        };
    }

    public function actionUpdate()
    {
        $data = $_POST;
        if (!empty($_FILES['cover']['tmp_name']) && getimagesize($_FILES["cover"]["tmp_name"])) {
            $data['cover'] = FileManager::upload($_FILES['cover']);
        }

        if ($this->validateData($data)) {
            AlbumModel::update($data, [
                'id' => $_GET['id']
            ]);
            header('Location: /');
        }
    }

    public function actionDelete()
    {
        AlbumModel::delete([
            'id' => $_GET['id']
        ]);

        header('Location: /');
    }

    /**
     * Условная валидация
     *
     * @param $data
     * @return array
     */
    protected function validateData($data)
    {
        return true;
    }

}