<?php

class Price
{
    const NAME_DB = 'price';
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById(self::NAME_DB, $id);

        $db = Db::getConnection();
        $result = $db->query("SELECT direction_id, services_id FROM " . self::NAME_DB . " WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['direction_id'] = $row['direction_id'];
            $data['services_id'] = $row['services_id'];
        }
        $data['services_id'] = json_decode(str_replace("!", "", $data['services_id']));
        $data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
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
