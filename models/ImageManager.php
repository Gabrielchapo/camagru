<?php

class ImageManager extends Model
{
    public function getAllImages()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM images ORDER BY date_creation');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Image($data);
        }
        $req->closeCursor();
        return $var;
    }

    public function getNbImages()
    {
        $req = $this->getBdd()->prepare('SELECT COUNT(id_image) FROM images');
        $req->execute();
        $result = $req->fetch();
        return $result["COUNT(id_image)"];
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

    public function addImages($date_creation, $adress, $id_author)
    {
        $sql = 'INSERT INTO images VALUES (id_image, :date_creation, :adress, :id_author)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'date_creation' => $date_creation,
            'adress' => $adress,
            'id_author' => $id_author,
        ]);
    }
}