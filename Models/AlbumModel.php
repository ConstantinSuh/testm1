<?php

namespace Models;

use Components\App;

class AlbumModel extends BaseModel
{

    public static $tableName = 'albums';


    public function search($data)
    {
        $qb = self::builder();
        if (!empty($data['filter']['id'])) {
            $qb->where('id', $data['filter']['id']);
        }

        if (!empty($data['filter']['title'])) {
            $qb->where('title', $data['filter']['title']);
        }

        if (!empty($data['filter']['artist_name'])) {
            $qb->where('artist_name', $data['filter']['artist_name']);
        }

        if (!empty($data['filter']['release_year'])) {
            $qb->where('release_year', $data['filter']['release_year']);
        }

        if (!empty($data['filter']['duration'])) {
            $qb->where('duration', $data['filter']['duration']);
        }

        if (!empty($data['filter']['price'])) {
            $qb->where('price', $data['filter']['price']);
        }

        if (!empty($data['filter']['warehouse_code'])) {
            $qb->where('warehouse_code', $data['filter']['warehouse_code']);
        }

        foreach ($data['sort'] ?? [] as $field => $sort) {
            if ($sort) {
                $qb->order($field, $sort);
            }
        }
        return $qb->fetch();
    }

    public static function beforeDelete($where)
    {
        $albums = self::builder()
            ->whereArray($where)
            ->fetch();

        foreach ($albums as $album) {
            if (!empty($album['cover']) && file_exists(App::app()->config['filepath'] . DIRECTORY_SEPARATOR . $album['cover'])) {
                unlink(App::app()->config['filepath'] . DIRECTORY_SEPARATOR . $album['cover']);
            }
        }
    }

}