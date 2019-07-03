<?php

class MemberManager extends Model
{
    public function getAllMembers()
    {
        return $this->getAll("member", "Member");
    }

    public function getMemberPassword($login)
    {
        $sql = 'SELECT password, id_member FROM member where login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['login' => $login]);
        $result = $req->fetch();
        return $result;
    }
    public function getMemberEmail($login)
    {
        $sql = 'SELECT email FROM member where login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['login' => $login]);
        $result = $req->fetch();
        return $result['email'];
    }

    public function addMember($login, $email, $password)
    {
        $sql = 'INSERT INTO member VALUES (id_member, :login, :password, :email, confirmEmail, preference, token)';
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

    public function confirmMembership($login)
    {
        $sql = 'UPDATE member SET confirmEmail = 1 WHERE login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['login' => $login]);
    }

    public function getMemberconfirmation()
    {
        session_start();
        $sql = 'SELECT confirmEmail FROM member WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $_SESSION['id'],]);
        $result = $req->fetch();
        if ($result["confirmEmail"] == 1)
            return true;
        else
            return false;
    }

    public function getMemberById($id)
    {
        $sql = 'SELECT email, preference FROM member where id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        $result = $req->fetch();
        return $result;
    }

    public function desactivateComment()
    {
        session_start();
        $sql = 'UPDATE member SET preference = 1 WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $_SESSION['id'],]);
    }
    public function activateComment()
    {
        session_start();
        $sql = 'UPDATE member SET preference = 0 WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['id' => $_SESSION['id'],]);
    }

    public function addToken($token, $login)
    {
        $sql = 'UPDATE member SET token = :token WHERE login = :login';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'token' => $token,
            'login' => $login,
            ]);
    }

    public function checkToken($token)
    {
        $sql = 'SELECT id_member FROM member WHERE token = :token';
        $req = $this->getBdd()->prepare($sql);
        $req->execute(['token' => $token]);
        $result = $req->fetch();
        if ($result["id_member"])
            return $result["id_member"];
        else
            return false;
    }

    public function resetPassword($id_member, $password)
    {
        $sql = 'UPDATE member SET password = :new_password WHERE id_member = :id';
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            'new_password' => hash('whirlpool', $password),
            'id' => $id_member,
            ]);
    }
}