<?php

class Programs
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('programs', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT direction_id, data_field, tipe FROM `programs` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['direction_id'] = $row['direction_id'];
            $data['data_field'] = $row['data_field'];
            $data['tipe'] = $row['tipe'];
        }
		$data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
    }
    public static function edit($id, $json_content, $direction_id, $data_field, $tipe)
    {
        $db = Db::getConnection();
        $sql = "UPDATE programs SET json_content=?, direction_id=?, data_field=?, tipe=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $direction_id, $data_field, $tipe, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE programs SET json_content=?, direction_id=?, data_field=?, tipe=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $direction_id, $data_field, $tipe, $id]);
            if ($result->errorCode() == "00000") return true;
            else return false;
        } else {
            return false;
        }
    }
    public static function deleteById($id)
    {
        $db = Db::getConnection();
        $sql = "DELETE FROM programs WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM programs WHERE id=?";
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
    public static function addNew($id, $json_content, $lang, $data_field, $tipe)
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
        $sql = "UPDATE programs SET json_content=?, data_field=?, tipe=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $tipe, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE programs SET json_content=?, data_field=?, tipe=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $tipe, $id, $id]);
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
