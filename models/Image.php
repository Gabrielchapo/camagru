<?php

class Image
{
    private $_id_image;
    private $_date_creation;
    private $_address;
    private $_id_author;

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
    public function setId_image($id_image)
    {
        $id_image = (int) $id_image;

        if ($id_image > 0)
            $this->_id_image = $id_image;
    }
    public function setDate_creation($date_creation)
    {
        $this->_date_creation = $date_creation;
    }
    public function setaddress($address)
    {
        $this->_address= $address;
	}
	public function setId_author($id_author)
    {
		if ($id_author > 0)
            $this->_id_author = $id_author;
    }

	// GET FUNCTIONS
    public function getId_image()
    {
        return $this->_id_image;
    }
    public function getDate_creation()
    {
        return $this->_date_creation;
    }
    public function getaddress()
    {
        return $this->_address;
	}
	public function getId_author()
    {
    	return $this->_id_author;
    }
}