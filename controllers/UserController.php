<?php


class UserController
{
    public function actionRegister()
    {
        $user_data = SiteFunction::checkLogin();
        $login = "";
        $mail = "";
        $password = "";
        $error = false;
        $db_result = '';
        SiteFunction::checkAdmin(User::getRole($_SESSION['user']));
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (!User::checkName($login)) {
                $error[] = "Имя не должно быть короче 2-х символов";
            }

            if (!User::checkEmail($mail)) {
                $error[] = "Неправильный Email";
            }

            if (!User::checkPassword($password)) {
                $error[] = "Пароль не должен быть меньше 6-ти символов!!!";
            }
            if (!User::checkEmailExists($mail)) {
                $error[] = "Такой email уже используется";
            }
            if (!User::checkLoginRegister($login)) {
                $error[] = "Такой логин уже используется";
            }


            if ($error == false) {
                $result = User::register($login, $mail, $password, $role);
                if ($result) {
                    $db_result = "<p>Пользователь добавлен!!!</p>";
                } else {
                    $db_result = "<p>Ошибка при добавлении пользователя!!!</p>";
                }
            }
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }

    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = User::getAllUsers();
        require_once(ROOT . '/views/user/users_archiv.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $error = false;
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $db_result = '';

            if (!User::checkName($login)) {
                $error[] = "Имя не должно быть короче 2-х символов";
            }

            if (!User::checkEmail($mail)) {
                $error[] = "Неправильный Email";
            }

            if (!User::checkPassword($password)) {
                $error[] = "Пароль не должен быть меньше 6-ти символов!!!";
            }
            if (!User::checkEditMail($mail, $id)) {
                $error[] = "Такой email уже используется";
            }
            if (!User::checkEditLogin($login, $id)) {
                $error[] = "Такой логин уже используется";
            }
            if ($error == false) {
                $result = User::edit($login, $mail, $password, $id, $role);
                if ($result) {
                    $db_result = "<p>Данные изменены!!!</p>";
                } else {
                    $db_result = "<p>Ошибка при добавлении пользователя!!!</p>";
                }
            }
        } else {
            $error = false;
            $db_result = '';
            $data = User::getUserById($id);
            $login = $data['login'];
            $mail = $data['mail'];
            $password = $data['password'];
            $role = $data['role'];
        }
        if (isset($_POST['delete'])) {
            $result = User::delete($id);
            if ($result) {
                header("Location: /user/all/", TRUE, 301);
                exit();
            } else {
                $db_result = "<p>Ошибка баз данных при удалении пользователя!!!</p>";
            }
        }
        require_once(ROOT . '/views/user/editor.php');
        return true;
    }

    public function actionLogin()
    {

        $login = "";
        $password = "";
        $error = false;

        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $userId = User::checkLogin($login, $password);
            if ($userId) {
                User::auth($userId);
                header('Location: /admin');
            } else {
                $error = "<p>Неверный логин или пароль</p>";
            }
        }
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}
