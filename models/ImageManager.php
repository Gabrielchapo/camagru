<?php

class ImageManager extends Model
{
    public function getAllImages()
    {
        return $this->getAll('images', 'Image');
    }

    public function getMemberImages($id)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM images WHERE id_author = :id');
        $req->execute(["id" => $id]);
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Image($data);
        }
        $req->closeCursor();
        return $var;
    }
}