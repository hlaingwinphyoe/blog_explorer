<?php

namespace App\Classes;

class FileControl
{
    public static function fileSave($inputName,$storeDir=""){
        $dir = 'public/'.$storeDir;
        $newName = $inputName.uniqid()."_.".request()->file($inputName)->extension();
        request()->file('cover')->storeAs($dir,$newName);

        return $newName;
    }
}
