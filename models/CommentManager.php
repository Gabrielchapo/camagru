<?php

class CommentManager extends Model
{
    public function getAllComments()
    {
        return $this->getAll("comments", "Comment");
    }

    public function addComment($date_comment, $content, $id_picture)
    {
        $sql = 'INSERT INTO comments VALUES (id_comments, :date_comment, :content, :id_picture)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
			'date_comment' => $date_comment,
			'content' => $content,
			'id_picture' => $id_picture,
        ]);
	}
}