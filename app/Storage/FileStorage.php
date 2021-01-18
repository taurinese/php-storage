<?php

namespace App\Storage;

class FileStorage{

    function __construct()
    {
        if ( !is_dir( __DIR__ . '/items/' ) ) {
            mkdir( __DIR__ . '/items/' );       
        }
    }

    function set($key, $value){
        file_put_contents(__DIR__ . '/items/' . $key, serialize($value));
        return true;
    }

    function get($key){
        return unserialize(file_get_contents(__DIR__ . '/items/' . $key));
    }

    function delete($key){
        return unlink(__DIR__ . '/items/' . $key);
    }

    function destroy(){
        $files = glob(__DIR__ . '/items/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                unlink($file); // delete file
            }
        return true;
}
    }

    function all(){
        $files = glob(__DIR__ . '/items/*');
        $filesToSend = [];
        foreach ($files as $file) {
            $filesToSend[] = [
                basename($file) => unserialize(file_get_contents($file))
            ];
        }
        return $filesToSend;
    }
}