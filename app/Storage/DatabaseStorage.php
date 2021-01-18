<?php

namespace App\Storage;

use App\Storage\Contracts\StorageInterface;

class DatabaseStorage implements StorageInterface{

    protected $db;

    function __construct()
    {
        try {
            $this->db = new \PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASSWORD']}", array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); //affichage des erreurs
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function set($key, $value){
        $query = $this->db->prepare('INSERT INTO items (id, value) VALUES (:id, :value)');
        $query->execute([
            "id" => $key,
            "value" => serialize($value)
        ]);
        return $this->db->lastInsertId();
    }

    function get($key){
        $query = $this->db->prepare('SELECT value FROM items WHERE id = :id');
        $query->execute([
            'id' => $key
        ]);
        return unserialize($query->fetch()['value']);
    }

    function delete($key){
        $query = $this->db->prepare('DELETE FROM items WHERE id = :id');
        $query->execute([
            "id" => $key
        ]);
        return true;
    }

    function destroy(){
        $query = $this->db->query('DELETE FROM items');
        return true;
    }

    function all(){
        $query = $this->db->query('SELECT * FROM items');
        $items = $query->fetchAll();
        $itemsToSend = [];
        foreach($items as $data){
            $itemsToSend[] = [
                $data['id'] => unserialize($data['value'])
            ];
        };
        return $itemsToSend;
    }
};