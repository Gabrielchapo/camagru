<?php

class MemberManager extends Model
{
    public function getMembers()
    {
        return $this->getAll('member', 'Member');
    }

    public function addMember($login, $email, $password)
    {
        $sql = 'INSERT INTO member VALUES (id_member, :login, :password, :email, privilege)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'login' => $login,
            'password' => $password,
            'email' => $email,
        ]);
    }
}