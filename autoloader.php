<?php

spl_autoload_register(function ($className) {

    $parts = explode('\\', $className);
    foreach ($parts as $key => $part) {
        if ($key !== (count($parts) - 1) ) {
            $parts[$key] = mb_strtolower($part);
        }
    }

    $className = implode('/', $parts);
    $className = ($className) . '.php';
    $fileName = __DIR__. DIRECTORY_SEPARATOR . $className;
    if (file_exists($fileName)) {
        require $fileName;
    }
});