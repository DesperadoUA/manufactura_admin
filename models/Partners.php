<?php

class Partners
{
    const NAME_DB = 'partners';
    public static function edit($id, $json_content)
    {
        $db = Db::getConnection();
        $sql = "UPDATE " . self::NAME_DB . " SET json_content=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . self::NAME_DB . " SET json_content=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $id]);
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

    public static function addNew($id, $json_content, $lang)
    {
        if ($lang == "Ru") $lang_field = 'ru_id';
        if ($lang == "Ua") $lang_field = 'ua_id';
        if ($lang == "En") $lang_field = 'en_id';

        $db = Db::getConnection();
        $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . self::NAME_DB . " SET json_content=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $id, $id]);
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
