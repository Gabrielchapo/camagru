<?php

abstract class Model
{
    private static $_bdd;

    // instancie la connexion a la bdd
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'clemclem');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //recuperer la connexon a la bdd
    protected function getBdd()
    {
        if(self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
    }

    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBdd('SELECT * FROM '.$table.'ORDER BY id desc');
        $req = execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}