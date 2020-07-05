<?php

class User
{
    public static function register($login, $mail, $password, $role)
    {
        $db = Db::getConnection();
        $result = $db->query("INSERT INTO `users` (login, mail, password, role) VALUES ('" . $login . "', '" . $mail . "', '" . $password . "', '" . $role . "')");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function edit($login, $mail, $password, $id, $role)
    {
        $password = md5($password);
        $db = Db::getConnection();
        $result = $db->query("UPDATE `users` SET login='" . $login . "', mail='" . $mail . "',  password='" . $password . "',  role='" . $role . "' WHERE id='" . $id . "'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function delete($id)
    {
        $db = Db::getConnection();
        $result = $db->query("DELETE FROM `users` WHERE id='" . $id . "'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function getUserById($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM `users` WHERE id='$id'");
        $i = 0;
        while ($row = $result->fetch()) {
            $data['id'] = $row['id'];
            $data['login'] = $row['login'];
            $data['mail'] = $row['mail'];
            $data['password'] = $row['password'];
            $data['role'] = $row['role'];
            $i++;
        }
        return $data;
    }
    public static function checkName($name)
    {

        if (iconv_strlen($name, 'UTF-8') >= 4) {
            return true;
        }
        return false;
    }
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public static function checkEmailExists($mail)
    {
        $db = Db::getConnection();
        $data = "";
        $result = $db->query("SELECT `id` FROM `users` where mail='" . $mail . "'");
        while ($row = $result->fetch()) {
            $data = $row['id'];
        }
        if ($data) {
            return false;
        } else {
            return true;
        }
    }
    public static function checkLogin($login, $password)
    {
        $password = md5($password);
        $db = Db::getConnection();
        $result = $db->query("SELECT id FROM `users` where login='" . $login . "' AND password='" . $password . "'");
        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }
    public static function checkLogged()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    public static function checkLoginRegister($login)
    {
        $db = Db::getConnection();
        $data = "";
        $result = $db->query("SELECT `id` FROM `users` where login='" . $login . "'");
        while ($row = $result->fetch()) {
            $data = $row['id'];
        }
        if ($data) {
            return false;
        } else {
            return true;
        }
    }
    public static function checkEditLogin($login, $id)
    {
        $db = Db::getConnection();
        $data = "";
        $result = $db->query("SELECT `id` FROM `users` where login='" . $login . "' AND id NOT IN(" . $id . ")");
        while ($row = $result->fetch()) {
            $data = $row['id'];
        }
        if ($data) {
            return false;
        } else {
            return true;
        }
    }
    public static function checkEditMail($mail, $id)
    {
        $db = Db::getConnection();
        $data = "";
        $result = $db->query("SELECT `id` FROM `users` where login='" . $mail . "' AND id NOT IN(" . $id . ")");
        while ($row = $result->fetch()) {
            $data = $row['id'];
        }
        if ($data) {
            return false;
        } else {
            return true;
        }
    }
    public static function getAllUsers()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT `id`, `login` FROM `users`");
        $i = 0;
        while ($row = $result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['login'] = $row['login'];
            $i++;
        }
        return $data;
    }
    public static function getRole($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT `role`, `login` FROM `users` WHERE id='" . $id . "'");
        $i = 0;
        while ($row = $result->fetch()) {
            $data['role'] = $row['role'];
            $data['login'] = $row['login'];
            $i++;
        }
        return $data;
    }
}
