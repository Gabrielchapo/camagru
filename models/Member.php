<?php

class Member
{
    private $_id_member;
    private $_login;
    private $_password;
	private $_email;
	private $_privilege;

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
    public function setId_member($id_member)
    {
        $id = (int) $id;

        if ($id > 0)
            $this->_id_member = $id;
    }
    public function setLogin($login)
    {
        if(is_string($login))
            $this->_login = $login;
    }
    public function setPassword($password)
    {
		//ADD condition protection password
        $this->_password = $paswword;
	}
	public function setEmail($email)
    {
		//ADD condition protection email
        if(is_string($email))
            $this->_email = $email;
    }
    public function setPrivilege($privilege)
    {
		//ADD condition protection password
        $this->_privilege = $privilege;
	}
	
	// GET FUNCTIONS
    public function getId_member()
    {
        return $this->_id_member;
    }
    public function getLogin()
    {
        return $this->_login;
    }
    public function getPassword()
    {
        return $this->_password;
	}
	public function getEmail()
    {
    	return $this->_email;
    }
    public function getPrivilege()
    {
        return $this->_privilege;
	}
}