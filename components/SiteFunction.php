<?php
class SiteFunction
{
    public static function getLang()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (strpos($url, '/ru/') === 0) {
            $lang = 1;
        } else if (strpos($url, '/en/') === 0) {
            $lang = 2;
        } else {
            $lang = 3;
        }

        return $lang;
    }
    private static function getNameLangColumn($lang)
    {
        if ($lang == "Ru") {
            return "ru_id";
        }
        if ($lang == "En") {
            return "en_id";
        }
        if ($lang == "Ua") {
            return "ua_id";
        }
    }
    public static function getPaginationPage()
    {
        $number_page = "";
        $lang = self::getLang();
        $url = explode("/", $_SERVER['REQUEST_URI']);
        if ($lang == 1) {
            count($url) == 3
                ? $number_page = 0
                : $number_page = $url[2];
        } else {
            count($url) == 4
                ? $number_page = 0
                : $number_page = $url[3];
        }
        return $number_page;
    }
    public static function getPermalink()
    {
        return $_SERVER['REQUEST_URI'];
    }
    public static function getId()
    {
        $url = explode("/", $_SERVER['REQUEST_URI']);
        return $url[count($url) - 2];
    }
    public static function checkAdmin($user_data)
    {
        if ($user_data['role'] != "Admin") {
            header('Location: /admin/');
        }
    }
    public static function checkLogin()
    {
        if ($_SERVER['REQUEST_URI'] != '/') {
            if (User::isGuest()) {
                header('Location: /');
            }
            $user_data = User::getRole($_SESSION['user']);
            return $user_data;
        } else {
            if (!User::isGuest()) {
                header('Location: /admin/');
            }
        }
    }
    public static function logOut()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }
    public static function getDataByArchiv($name_db)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM `$name_db` ORDER BY data DESC");
        $i = 0;
        $data = [];
        while ($row = $result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['slug'] = $row['slug'];
            $data[$i]['post_title'] = $row['post_title'];
            $i++;
        }
        if (is_array($data)) return $data;
        else return true;
    }
    public static function getDataByArchivStaticPage()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM static_page ORDER BY data DESC");
        $i = 0;
        $data = [];
        while ($row = $result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['post_title'] = $row['post_title'];
            $i++;
        }
        if (is_array($data)) {
            return $data;
        } else {
            return true;
        }
    }
    public static function getCommonDataById($name_db, $id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, permalink, post_title, img, data, status, description, title, keywords, short_desc, json_content, lang, ua_id, en_id, ru_id FROM `$name_db` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['id'] = $row['id'];
            $data['permalink'] = $row['permalink'];
            $data['post_title'] = $row['post_title'];
            $data['img'] = $row['img'];
            $data['post_data'] = substr($row['data'], 0, 10);
            $data['status'] = $row['status'];
            $data['description'] = $row['description'];
            $data['title'] = $row['title'];
            $data['keywords'] = $row['keywords'];
            $data['short_desc'] = $row['short_desc'];
            $data['json_content'] = json_decode($row["json_content"], true);
            $data['lang'] = $row['lang'];
            $data['ua_id'] = $row['ua_id'];
            $data['en_id'] = $row['en_id'];
            $data['ru_id'] = $row['ru_id'];
        }
        return $data;
    }
    public static function updateCommonData($name_db, $id)
    {
        $data['permalink'] = $_POST['permalink'];
        $data['post_title'] = $_POST['post_title'];
        $data['defolt_lang_1'] = $_POST['defolt_lang_1'];
        $data['defolt_lang_2'] = $_POST['defolt_lang_2'];
        $data['post_data'] = $_POST['post_data'];

        if ($_POST['lang'] == 'Ru') {
            $data['lang'] = "1";
            $data['ru_id'] = $id;
            $data['en_id'] = array_key_exists('lang_1', $_POST) ? $_POST['lang_1'][0] : 0;
            $data['ua_id'] = array_key_exists('lang_2', $_POST) ? $_POST['lang_2'][0] : 0;

            if ($data['en_id'] != 0 && $data['ua_id'] != 0) {
                if ($data['en_id'] != $data['defolt_lang_1'] || $data['ua_id'] != $data['defolt_lang_2']) {

                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['en_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['en_id'], $data['ua_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['ua_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ua_id'], $data['en_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['en_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }

                    if ($data['ua_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['en_id'] == 0 || $data['ua_id'] == 0) {
                if ($data['en_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ua_id'], 0)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['ua_id'], $id)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_1'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_2'] != 0 && $data['ua_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }

                if ($data['ua_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['en_id'], 0)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['en_id'], $id)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_2'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_1'] != 0 && $data['en_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['en_id'] == 0 && $data['ua_id'] == 0) {
                if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }

                if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
            }
        };

        if ($_POST['lang'] == 'En') {
            $data['lang'] = "2";
            $data['en_id'] = $id;
            $data['ru_id'] = array_key_exists('lang_1', $_POST) ? $_POST['lang_1'][0] : 0;
            $data['ua_id'] = array_key_exists('lang_2', $_POST) ? $_POST['lang_2'][0] : 0;

            if ($data['ru_id'] != 0 && $data['ua_id'] != 0) {
                if ($data['ru_id'] != $data['defolt_lang_1'] || $data['ua_id'] != $data['defolt_lang_2']) {

                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ru_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['ru_id'], $data['ua_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ua_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['ua_id'], $data['ru_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['ru_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }

                    if ($data['ua_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['ru_id'] == 0 || $data['ua_id'] == 0) {
                if ($data['ru_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ua_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['ua_id'], 0)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_1'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_2'] != 0 && $data['ua_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }

                if ($data['ua_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['ru_id'], 0)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ru_id'], $id)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_2'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_1'] != 0 && $data['ru_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['ru_id'] == 0 && $data['ua_id'] == 0) {
                if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }

                if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
            }
        };

        if ($_POST['lang'] == 'Ua') {
            $data['lang'] = "3";
            $data['ua_id'] = $id;
            $data['ru_id'] = array_key_exists('lang_1', $_POST) ? $_POST['lang_1'][0] : 0;
            $data['en_id'] = array_key_exists('lang_2', $_POST) ? $_POST['lang_2'][0] : 0;

            if ($data['ru_id'] != 0 && $data['en_id'] != 0) //Выбраны оба перевода
            {
                if ($data['ru_id'] != $data['defolt_lang_1'] || $data['en_id'] != $data['defolt_lang_2']) //Переводы были изменены
                {
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['ru_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ru_id'], $data['en_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['en_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['en_id'], $data['ru_id'])) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['ru_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }

                    if ($data['en_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['ru_id'] == 0 || $data['en_id'] == 0) {
                if ($data['ru_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'ru_id', $data['en_id'], 0)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['en_id'], $id)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_1'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_2'] != 0 && $data['ua_id'] != $data['defolt_lang_2']) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }

                if ($data['en_id'] == 0) {
                    if (!self::updateRelativeLang($name_db, 'ua_id', $data['ru_id'], $id)) {
                        echo "Ошибка баз данных";
                    }
                    if (!self::updateRelativeLang($name_db, 'en_id', $data['ru_id'], 0)) {
                        echo "Ошибка баз данных";
                    }

                    if ($data['defolt_lang_2'] != 0) {
                        if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                    if ($data['defolt_lang_1'] != 0 && $data['ru_id'] != $data['defolt_lang_1']) {
                        if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                            echo "Ошибка баз данных";
                        }
                        if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_2'], 0)) {
                            echo "Ошибка баз данных";
                        }
                    }
                }
            } else if ($data['ru_id'] == 0 && $data['en_id'] == 0) {
                if (!self::updateRelativeLang($name_db, 'en_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_1'], 0)) {
                    echo "Ошибка баз данных";
                }

                if (!self::updateRelativeLang($name_db, 'ru_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
                if (!self::updateRelativeLang($name_db, 'ua_id', $data['defolt_lang_2'], 0)) {
                    echo "Ошибка баз данных";
                }
            }
        };

        if ($_FILES['img']['name']) {
            $file_tmp = $_FILES['img']['tmp_name'];
            $file_name = "template/uploads/" . time() . $_FILES['img']['name'];
            $expensions = array('jpeg', "jpg", "png");
            move_uploaded_file($file_tmp, $file_name);
            $data['img'] = "/" . $file_name;
        } else {
            $data['img'] = $_POST['defolt_img'];
        }
        $data['status'] = $_POST['status'];
        $data['description'] = $_POST['description'];
        $data['title'] = $_POST['title'];
        $data['keywords'] = $_POST['keywords'];
        $data['short_desc'] = $_POST['short_desc'];



        $db = Db::getConnection();
        $sql = "UPDATE `$name_db` SET data=?, permalink=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, short_desc=?, lang=?, ru_id=?, en_id=?, ua_id=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$data['post_data'], $data['permalink'], $data['post_title'], $data['img'], $data['status'], $data['description'], $data['title'], $data['keywords'], $data['short_desc'], $data['lang'], $data['ru_id'], $data['en_id'], $data['ua_id'], $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE `$name_db` SET data=?, permalink=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, short_desc=?, lang=?, ru_id=?, en_id=?, ua_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$data['post_data'], $data['permalink'], $data['post_title'], $data['img'], $data['status'], $data['description'], $data['title'], $data['keywords'], $data['short_desc'], $data['lang'], $data['ru_id'], $data['en_id'], $data['ua_id'], $id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            echo "error";
            return false;
        }
    }
    public static function addCommonData($name_db)
    {
        $data['post_title'] = $_POST['post_title'];
        $data['permalink'] = self::getUniqueUrl($name_db, $_POST['permalink']);
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        $data['keywords'] = $_POST['keywords'];
        $data['status'] = $_POST['status'];
        if ($_POST['lang'] == 'Ru') $data['lang'] = "1";
        if ($_POST['lang'] == 'En') $data['lang'] = "2";
        if ($_POST['lang'] == 'Ua') $data['lang'] = "3";

        if ($_FILES['img']['name']) {
            $file_tmp = $_FILES['img']['tmp_name'];
            $file_name = "template/uploads/" . time() . $_FILES['img']['name'];
            $expensions = array('jpeg', "jpg", "png");
            move_uploaded_file($file_tmp, $file_name);
            $data['img'] = "/" . $file_name;
        } else {
            $data['img'] = $_POST['defolt_img'];
        }
        $data['short_desc'] = $_POST['short_desc'];

        $db = Db::getConnection();
        $sql = "INSERT INTO `$name_db` (permalink, post_title, short_desc, img, status, description, title, keywords, lang) VALUES (:permalink, :post_title, :short_desc, :img, :status, :description, :title, :keywords, :lang)";
        $result = $db->prepare($sql);
        $result->bindParam(':permalink', $data['permalink']);
        $result->bindParam(':post_title', $data['post_title']);
        $result->bindParam(':short_desc', $data['short_desc']);
        $result->bindParam(':img', $data['img']);
        $result->bindParam(':status', $data['status']);
        $result->bindParam(':description', $data['description']);
        $result->bindParam(':title', $data['title']);
        $result->bindParam(':keywords', $data['keywords']);
        $result->bindParam(':lang', $data['lang']);
        $result->execute();
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "INSERT INTO `$name_db` (permalink, post_title, short_desc, img, status, description, title, keywords, lang) VALUES (:permalink, :post_title, :short_desc, :img, :status, :description, :title, :keywords, :lang)";
            $result = $db->prepare($sql);
            $result->bindParam(':permalink', $data['permalink']);
            $result->bindParam(':post_title', $data['post_title']);
            $result->bindParam(':short_desc', $data['short_desc']);
            $result->bindParam(':img', $data['img']);
            $result->bindParam(':status', $data['status']);
            $result->bindParam(':description', $data['description']);
            $result->bindParam(':title', $data['title']);
            $result->bindParam(':keywords', $data['keywords']);
            $result->bindParam(':lang', $data['lang']);
            $result->execute();
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function getLastId($name_db)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT MAX(id) FROM `$name_db`");
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data['MAX(id)'];
    }
    public static function getUniqueUrl($name_db, $url)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT permalink FROM `$name_db`");
        $i = 0;
        $data['permalink'] = [];
        while ($row = $result->fetch()) {
            $data['permalink'][$i] = $row['permalink'];
            $i++;
        }
        $i = 1;
        if (substr($url, -1) != "/") {
            $url = $url . '/';
        }
        $new_url = '';
        if (in_array($url, $data['permalink'])) {
            $old_url = $url;
            while (in_array($url, $data['permalink'])) {
                $url = substr_replace($old_url, '-' . $i . '/', -1, 1);
                $i++;
            }
            return $url;
        }
        return $url;
    }
    public static function getUrlsForTranslate($name_db, $lang, $field)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, post_title FROM `$name_db` WHERE lang='" . $lang . "' AND " . $field . "=0 ORDER BY data DESC");
        $i = 0;
        $data = [];
        while ($row = $result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['post_title'] = $row['post_title'];
            $i++;
        }
        if (is_array($data)) return $data;
        else return true;
    }
    private static function updateRelativeLang($name_db, $field, $id, $relativ_id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE `$name_db` SET `$field`=" . $relativ_id . " WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE `$name_db` SET `$field`=" . $relativ_id . " WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            echo "error";
            return false;
        }
    }
    public static function getPostTitleById($name_db, $id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT post_title FROM `$name_db` WHERE id=" . $id);
        $data = '';
        while ($row = $result->fetch()) {
            $data = $row['post_title'];
        }
        return $data;
    }
    public static function getRelativPost($data, $name_db)
    {
        if ($data['ru_id'] != 0) {
            $data['ru_post_title'] = self::getPostTitleById($name_db, $data['ru_id']);
        }
        if ($data['ua_id'] != 0) {
            $data['ua_post_title'] = self::getPostTitleById($name_db, $data['ua_id']);
        }
        if ($data['en_id'] != 0) {
            $data['en_post_title'] = self::getPostTitleById($name_db, $data['en_id']);
        }

        if ($data['lang'] == 1) {
            $data['lang_first'] = self::getUrlsForTranslate($name_db, '2', 'ru_id');
            $data['lang_second'] = self::getUrlsForTranslate($name_db, "3", 'ru_id');
        }
        if ($data['lang'] == 2) {
            $data['lang_first'] = self::getUrlsForTranslate($name_db, '1', "en_id");
            $data['lang_second'] = self::getUrlsForTranslate($name_db, '3', "en_id");
        }
        if ($data['lang'] == 3) {
            $data['lang_first'] = self::getUrlsForTranslate($name_db, '1', "ua_id");
            $data['lang_second'] = self::getUrlsForTranslate($name_db, '2', "ua_id");
        }
        return $data;
    }
    public static function deleteById($id, $name_db, $lang)
    {
        $db = Db::getConnection();
        $sql = "DELETE FROM `$name_db` WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM `$name_db` WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$id]);
            if ($result->errorCode() == "00000") {
                $lang_column = self::getNameLangColumn($lang);
                $db = Db::getConnection();
                $sql = "UPDATE `$name_db` SET `$lang_column`=0 WHERE `$lang_column`=?";
                $result = $db->prepare($sql);
                $result->execute([$id]);
                if ($result->errorCode() == "00000") {
                    $db = Db::getConnectionFront();
                    $sql = "UPDATE `$name_db` SET `$lang_column`=0 WHERE `$lang_column`=?";
                    $result = $db->prepare($sql);
                    $result->execute([$id]);
                    if ($result->errorCode() == "00000") {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function getUniqueRow($name_db, $lang)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, post_title FROM `$name_db` WHERE  lang=" . $lang);
        $data = [];
        while ($row = $result->fetch()) {
            $data['id'][] = $row['id'];
            $data['post_title'][] = $row['post_title'];
        }
        return $data;
    }
}
