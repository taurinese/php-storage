<?php

namespace App\Storage;

class SessionStorage{
    function set($key, $value){
        $_SESSION['items'][$key] = serialize($value); 
        return true;
    }

    function get($key){
        return unserialize($_SESSION['items'][$key]);
    }

    function delete($key){
        unset($_SESSION['items'][$key]);
        return true;
    }

    function destroy(){
        $_SESSION['items'] = [];
        return true;
    }

    function all(){
        $items = [];
        foreach($_SESSION['items'] as $key => $value){
            $items[] = [
                $key => unserialize($value)
            ];
        }
        return $items;
    }
}