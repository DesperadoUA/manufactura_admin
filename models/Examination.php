<?php

class Examination
{
    const NAME_DB = 'examination';
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById(self::NAME_DB, $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT type FROM " . self::NAME_DB . " WHERE id=" . $id);
        while ($row = $result->fetch()) $data['type'] = $row['type'];
        return $data;
    }
    public static function edit($id, $json_content, $type)
    {
        $db = Db::getConnection();
        $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, type=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $type, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, type=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $type, $id]);
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
        $sql = "DELETE FROM " . self::NAME_DB . " WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM " . self::NAME_DB . " WHERE id=?";
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
    public static function addNew($id, $json_content, $type, $lang)
    {
        if ($lang == "Ru") $lang_field = 'ru_id';
        if ($lang == "Ua") $lang_field = 'ua_id';
        if ($lang == "En") $lang_field = 'en_id';

        $db = Db::getConnection();
        $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, `$lang_field`=?, type=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id, $type, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, `$lang_field`=?, type=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $id, $type, $id]);
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
