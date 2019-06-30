<?php

class Like
{
    private $_id_like;
    private $_id_author;
	private $_id_image;
	
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    // SET FUNCTIONS
    public function setId_like($id_like)
    {
        $id_like = (int) $id_like;

        if ($id_like > 0)
            $this->_id_like = $id_like;
    }
	public function setId_author($id_author)
    {
		if ($id_author > 0)
            $this->_id_author = $id_author;
    }
    public function setId_image($id_image)
    {
		if ($id_image > 0)
            $this->_id_image = $id_image;
    }
	
	// GET FUNCTIONS
    public function getId_image()
    {
        return $this->_id_image;
    }
	public function getId_author()
    {
    	return $this->_id_author;
    }
    public function getId_likes()
    {
    	return $this->_id_likes;
    }
}