<?php

class Staff
{

    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('staff', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT desc_doc, expirience, direction_id, services_id FROM `staff` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['desc_doc'] = $row['desc_doc'];
            $data['expirience'] = $row['expirience'];
            $data['direction_id'] = $row['direction_id'];
            $data['services_id'] = $row['services_id'];
        }
        $data['services_id'] = json_decode(str_replace("!", "", $data['services_id']));
		$data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
    }
    public static function edit($id, $json_content, $desc_doc, $expirience, $direction_id, $services_id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE staff SET json_content=?, desc_doc=?, expirience=?, direction_id=?, services_id=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $desc_doc, $expirience, $direction_id, $services_id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE staff SET json_content=?, desc_doc=?, expirience=?, direction_id=?, services_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $desc_doc, $expirience, $direction_id, $services_id, $id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function deleteById($id, $lang)
    {
        self::updateRelativData('reviews', $id);
        if (SiteFunction::deleteById($id, 'staff', $lang)) {
            header('Location: /staff/all/');
        } else {
            return false;
        }
    }
    public static function addNew($id, $json_content, $desc_doc, $expirience, $lang)
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
        $sql = "UPDATE staff SET json_content=?, desc_doc=?, expirience=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $desc_doc, $expirience, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE staff SET json_content=?, desc_doc=?, expirience=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $desc_doc, $expirience, $id, $id]);
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private static function updateRelativData($templat, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE " . $templat . " SET staff_id = 0 WHERE staff_id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . $templat . " SET staff_id = 0 WHERE staff_id=?";
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
}
