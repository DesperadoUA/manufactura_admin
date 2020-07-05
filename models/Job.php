<?php

class Job
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('job', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT data_field, job_desc FROM `job` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['data_field'] = $row['data_field'];
            $data['job_desc'] = $row['job_desc'];
        }
        return $data;
    }

    public static function edit($id, $json_content, $data_field, $job_desc)
    {
        $db = Db::getConnection();
        $sql = "UPDATE job SET json_content=?, data_field=?, job_desc=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $job_desc, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE job SET json_content=?, data_field=?, job_desc=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $job_desc, $id]);
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
        $sql = "DELETE FROM job WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM job WHERE id=?";
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
    public static function addNew($id, $json_content, $data_field, $job_desc, $lang)
    {
        if ($lang == "Ru") $lang_field = 'ru_id';
        if ($lang == "Ua") $lang_field = 'ua_id';
        if ($lang == "En") $lang_field = 'en_id';

        $db = Db::getConnection();
        $sql = "UPDATE job SET json_content=?, data_field=?, job_desc=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $job_desc, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE job SET json_content=?, data_field=?, job_desc=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $job_desc, $id, $id]);
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
