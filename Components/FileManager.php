<?php

namespace Components;


class FileManager
{
    public static function upload($file)
    {
        $filename = uniqid('cover_');
        move_uploaded_file($file['tmp_name'], App::app()->config['filepath'] . DIRECTORY_SEPARATOR . $filename);
        return $filename;
    }
}