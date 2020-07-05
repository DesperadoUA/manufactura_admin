<?php

class Reviews
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('reviews', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT direction_id, staff_id FROM `reviews` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['direction_id'] = $row['direction_id'];
            $data['staff_id'] = $row['staff_id'];
        }
        return $data;
    }
    public static function edit($id, $json_content, $direction_id, $staff_id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE reviews SET json_content=?, direction_id=?, staff_id=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $direction_id, $staff_id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE reviews SET json_content=?, direction_id=?, staff_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $direction_id, $staff_id, $id]);
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
        $sql = "DELETE FROM reviews WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM reviews WHERE id=?";
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
        $sql = "UPDATE reviews SET json_content=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE reviews SET json_content=?, `$lang_field`=? WHERE id=?";
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
