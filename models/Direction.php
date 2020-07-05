<?php

class Direction
{

    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('direction', $id);
        return $data;
    }
    public static function edit($id, $json_content)
    {
        $db = Db::getConnection();
        $sql = "UPDATE direction SET json_content=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE direction SET json_content=? WHERE id=?";
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
    public static function deleteById($id, $lang)
    {
        self::updateRelativDataMultiple('blog', $id);
        self::updateRelativDataMultiple('staff', $id);
        self::updateRelativDataMultiple('news', $id);
        self::updateRelativDataMultiple('shares', $id);
        self::updateRelativData('qa', $id);
        self::updateRelativDataMultiple('programs', $id);
        self::updateRelativData('reviews', $id);
        self::updateRelativData('services', $id);
        self::updateMultipleRelativData('price', $id);
        if (SiteFunction::deleteById($id, 'direction', $lang)) header('Location: /direction/all/');
        else return false;
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
        $sql = "UPDATE direction SET json_content=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE direction SET json_content=?, `$lang_field`=? WHERE id=?";
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
        $sql = "UPDATE " . $templat . " SET direction_id = 0 WHERE direction_id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . $templat . " SET direction_id = 0 WHERE direction_id=?";
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
    private static function updateRelativDataMultiple($templat, $id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, direction_id FROM `" . $templat . "` WHERE direction_id LIKE '%!" . $id . "!%'");
        $data['id'] = [];
        while ($row = $result->fetch()) {
            $data['id'][] = $row['id'];
            $data['direction_id'][] = json_decode($row['direction_id']);
        }
        $newData['direction_id'] = [];
        if (count($data['id']) != 0) {
            for ($i = 0; $i < count($data['id']); $i++) {
                if (count($data['direction_id'][$i]) === 1) {
                    $newData['direction_id'][$i] = "[]";
                } else {
                    for ($j = 0; $j < count($data['direction_id'][$i]); $j++) {
                        if ($data['direction_id'][$i][$j] != "!" . $id . "!") {
                            $newData['direction_id'][$i][$j] = '"' . $data['direction_id'][$i][$j] . '"';
                        }
                    }
                }
            }
        }
        for ($i = 0; $i < count($newData['direction_id']); $i++) {
            if ($newData['direction_id'][$i] != "[]") {
                $newData['direction_id'][$i] = "[" . implode(",", $newData['direction_id'][$i]) . "]";
            }
        }

        for ($i = 0; $i < count($data['id']); $i++) {
            $sql = "UPDATE " . $templat . " SET direction_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$newData['direction_id'][$i], $data['id'][$i]]);
        }

        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            for ($i = 0; $i < count($data['id']); $i++) {
                $sql = "UPDATE " . $templat . " SET direction_id=? WHERE id=?";
                $result = $db->prepare($sql);
                $result->execute([$newData['direction_id'][$i], $data['id'][$i]]);
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
    private static function updateMultipleRelativData($templat, $id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, direction_id FROM `" . $templat .
			"` WHERE direction_id LIKE '%!" . $id . "!%'");
        $data['id'] = [];
        while ($row = $result->fetch()) {
            $data['id'][] = $row['id'];
            $data['direction_id'][] = json_decode($row['direction_id']);
        }
        $newData['direction_id'] = [];
        if (count($data['id']) != 0) {
            for ($i = 0; $i < count($data['id']); $i++) {
                if (count($data['direction_id'][$i]) === 1) {
                    $newData['direction_id'][$i] = [];
                } else {
                    for ($j = 0; $j < count($data['direction_id'][$i]); $j++) {
                        if ($data['direction_id'][$i][$j] != "!" . $id . "!") {
                            $newData['direction_id'][$i][$j] = '"' . $data['direction_id'][$i][$j] . '"';
                        }
                    }
                }
            }
        }
        for ($i = 0; $i < count($newData['direction_id']); $i++) {
            if ($newData['direction_id'][$i] != 0) {
                $newData['direction_id'][$i] = "[" . implode(",", $newData['direction_id'][$i]) . "]";
            }
        }

        for ($i = 0; $i < count($data['id']); $i++) {
            $sql = "UPDATE " . $templat . " SET direction_id=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$newData['direction_id'][$i], $data['id'][$i]]);
        }

        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            for ($i = 0; $i < count($data['id']); $i++) {
                $sql = "UPDATE " . $templat . " SET direction_id=? WHERE id=?";
                $result = $db->prepare($sql);
                $result->execute([$newData['direction_id'][$i], $data['id'][$i]]);
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
