<?php

class Services
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('services', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT direction_id FROM `services` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['direction_id'] = $row['direction_id'];
        }
        return $data;
    }

    public static function edit($id, $json_content, $direction_id)
    {

        $db = Db::getConnection();
        $sql = "UPDATE services SET json_content=?, direction_id=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $direction_id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE services SET json_content=?, direction_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $direction_id, $id]);
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
        self::updateRelativData('staff', $id);
        self::updateRelativData('shares', $id);
        self::updateRelativData('price', $id);

        if (SiteFunction::deleteById($id, 'services', $lang)) {
            header('Location: /services/all/');
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
        $sql = "UPDATE services SET json_content=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE services SET json_content=?, `$lang_field`=? WHERE id=?";
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
    private static function updateRelativData($templat, $id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, services_id FROM `" . $templat . "` WHERE services_id LIKE '%!" . $id . "!%'");
        $data['id'] = [];
        while ($row = $result->fetch()) {
            $data['id'][] = $row['id'];
            $data['services_id'][] = json_decode($row['services_id']);
        }
        $newData['services_id'] = [];
        if (count($data['id']) != 0) {
            for ($i = 0; $i < count($data['id']); $i++) {
                if (count($data['services_id'][$i]) === 1) {
                    $newData['services_id'][$i] = [];
                } else {
                    for ($j = 0; $j < count($data['services_id'][$i]); $j++) {
                        if ($data['services_id'][$i][$j] != "!" . $id . "!") {
                            $newData['services_id'][$i][$j] = '"' . $data['services_id'][$i][$j] . '"';
                        }
                    }
                }
            }
        }
        for ($i = 0; $i < count($newData['services_id']); $i++) {
            if ($newData['services_id'][$i] != 0) {
                $newData['services_id'][$i] = "[" . implode(",", $newData['services_id'][$i]) . "]";
            }
        }

        for ($i = 0; $i < count($data['id']); $i++) {
            $sql = "UPDATE " . $templat . " SET services_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$newData['services_id'][$i], $data['id'][$i]]);
        }

        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            for ($i = 0; $i < count($data['id']); $i++) {
                $sql = "UPDATE " . $templat . " SET services_id=? WHERE id=?";
                $result = $db->prepare($sql);
                $result->execute([$newData['services_id'][$i], $data['id'][$i]]);
            }
            if ($result->errorCode() == "00000") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        return $data;
    }
}
