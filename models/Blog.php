<?php

class Blog
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('blog', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT data_field, direction_id, author FROM `blog` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['data_field'] = $row['data_field'];
            $data['direction_id'] = $row['direction_id'];
            $data['author'] = $row['author'];
        }
        $data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
    }

    public static function edit($id, $json_content, $data_field, $direction_id, $author)
    {
        $db = Db::getConnection();
        $sql = "UPDATE blog SET json_content=?, data_field=?, direction_id=?, author=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $direction_id, $author, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE blog SET json_content=?, data_field=?, direction_id=?, author=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $direction_id, $author, $id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function deleteById($id)
    {
        $db = Db::getConnection();
        $sql = "DELETE FROM blog WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM blog WHERE id=?";
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
    }

    public static function addNew($id, $json_content, $data_field, $lang, $author)
    {
        if ($lang == "Ru") $lang_field = 'ru_id';
        if ($lang == "Ua") $lang_field = 'ua_id';
        if ($lang == "En") $lang_field = 'en_id';

        $db = Db::getConnection();
        $sql = "UPDATE blog SET json_content=?, data_field=?, author=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $author, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE blog SET json_content=?, data_field=?, author=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $author, $id, $id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
