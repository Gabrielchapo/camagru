<?php

class ImageManager extends Model
{
    public function getAllImages()
    {
        return $this->getAll("images", "Image");
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

    public function getLast_id_plus_one()
    {
        $sql = "SELECT id_image FROM images ORDER BY id_image DESC LIMIT 1";
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $result = $req->fetch();
        return $result["id_image"] + 1;
    }

    public function deleteImage($id)
    {
        $sql = 'DELETE FROM images WHERE id_image = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
    }

    public function getIdAuthor($id_image)
    {
        $sql = "SELECT id_author FROM images WHERE id_image = :id_image";
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id_image' => $id_image]);
        $result = $req->fetch();
        return $result["id_author"];
    }
}