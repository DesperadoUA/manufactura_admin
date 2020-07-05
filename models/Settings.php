<?php

class Settings
{
    const NAME_DB = 'settings';
    public static function getDataById($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT short_desc, permalink, img, post_title, status, description, title, keywords, template, json_content FROM " . self::NAME_DB . "  WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['short_desc'] = $row['short_desc'];
            $data['permalink'] = $row['permalink'];
            $data['img'] = $row['img'];
            $data['post_title'] = $row['post_title'];
            $data['status'] = $row['status'];
            $data['description'] = $row['description'];
            $data['title'] = $row['title'];
            $data['keywords'] = $row['keywords'];
            $data['template'] = $row['template'];
            $data['json_content'] = json_decode($row["json_content"], true);
        }
        return $data;
    }
    public static function edit($short_desc, $post_title, $img, $status, $description, $title, $keywords, $json_content, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE " . self::NAME_DB . " SET short_desc=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, json_content=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$short_desc, $post_title, $img, $status, $description, $title, $keywords, $json_content, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE " . self::NAME_DB . " SET short_desc=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, json_content=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$short_desc, $post_title, $img, $status, $description, $title, $keywords, $json_content, $id]);
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
