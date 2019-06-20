<?php

class MemberManager extends Model
{
    public function getMemberPassword($login)
    {
        $sql = 'SELECT password, id_member FROM member where login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['login' => $login]);
        $result = $req->fetch();
        return $result;
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