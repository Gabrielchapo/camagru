<?php

class MemberManager extends Model
{
    public function getAllMembers()
    {
        return $this->getAll('member', 'Member');
    }

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
        $sql = 'INSERT INTO member VALUES (id_member, :login, :password, :email, confirmEmail, preference)';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'login' => $login,
            'password' => $password,
            'email' => $email,
        ]);
        $sql = 'SELECT id_member FROM member where login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['login' => $login]);
        $result = $req->fetch();
        return $result["id_member"];
    }

    public function modifyLogin($login)
    {
        session_start();
        $sql = 'UPDATE member SET login = :new_login WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'new_login' => $login,
            'id' => $_SESSION['id'],
            ]);
    }

    public function modifyEmail($email)
    {
        session_start();
        $sql = 'UPDATE member SET email = :new_email WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'new_email' => $email,
            'id' => $_SESSION['id'],
            ]);
    }

    public function modifyPassword($password)
    {
        session_start();
        $sql = 'UPDATE member SET password = :new_password WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'new_password' => $password,
            'id' => $_SESSION['id'],
            ]);
    }

    public function deleteMember($id)
    {
        $sql = 'DELETE FROM member WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
    }
}