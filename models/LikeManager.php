<?php

class LikeManager extends Model
{
    public function getAllLikes()
    {
        return $this->getAll("likes", "Like");
    }

    public function addLike($id_image, $id_author)
    {
        $sql = 'INSERT INTO likes VALUES (id_like, :id_image, :id_author)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'id_image' => $id_image,
            'id_author' => $id_author,
        ]);
	}
	
	public function disLike($id_image, $id_author)
    {
        $sql = 'DELETE FROM likes WHERE (id_image = :id_image AND id_author = :id_author)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'id_image' => $id_image,
            'id_author' => $id_author,
        ]);
    }
}