<?php

class News
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('news', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT data_field, direction_id FROM `news` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['data_field'] = $row['data_field'];
            $data['direction_id'] = $row['direction_id'];
        }
        $data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
    }
    public static function edit($id, $json_content, $data_field, $direction_id)
    {

        $db = Db::getConnection();
        $sql = "UPDATE news SET json_content=?, data_field=?, direction_id=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $direction_id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE news SET json_content=?, data_field=?, direction_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $direction_id, $id]);
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
        $sql = "DELETE FROM news WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM news WHERE id=?";
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
    public static function addNew($id, $json_content, $data_field, $lang)
    {
        if ($lang == "Ru") {
            $lang_field = 'ru_id';
        }
        if ($lang == "Ua") {
            $lang_field = 'ua_id';
        }
        if ($lang == "En") {
            $lang_field = 'en_id';
        }

        $db = Db::getConnection();
        $sql = "UPDATE news SET json_content=?, data_field=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE news SET json_content=?, data_field=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $id, $id]);
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
