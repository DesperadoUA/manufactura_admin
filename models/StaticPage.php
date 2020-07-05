<?php

class StaticPage
{
    public static function get_data($template)
    {
        $db = Db::getConnection();
        $data = array();
        $lang = SiteFunction::getLang();
        $result = $db->query("SELECT * FROM `static_page` where status='1' AND lang='" . $lang . "' AND template='" . $template . "'");
        $i = 0;
        while ($row = $result->fetch()) {
            $data['id'] = $row["id"];
            $data['short_desc'] = $row["short_desc"];
            $data['json_content'] = json_decode($row["json_content"], true);
            $data['title'] = $row["title"];
            $data['h1'] = $row["h1"];
            $data['description'] = $row["description"];
            $data['ua_id'] = $row["ua_id"];
            $data['ru_id'] = $row["ru_id"];
            $data['en_id'] = $row["en_id"];
            $i++;
        }

        $data['ua_id'] !== 0
            ? $data['permalink_ua'] = self::getPermalink($data['ua_id'])
            : $data['permalink_ua'] = 0;

        $data['ru_id'] !== 0
            ? $data['permalink_ru'] = self::getPermalink($data['ru_id'])
            : $data['permalink_ru'] = 0;

        $data['en_id'] !== 0
            ? $data['permalink_en'] = self::getPermalink($data['en_id'])
            : $data['permalink_en'] = 0;

        return $data;
    }

    private static function getPermalink($id)
    {
        $db = Db::getConnection();
        $data = "";
        $result = $db->query("SELECT `permalink` FROM `static_page` where status='1' AND id='" . $id . "'");
        while ($row = $result->fetch()) {
            $data = $row['permalink'];
        }
        return $data;
    }
    public static function getDataById($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT short_desc, permalink, img, post_title, status, description, title, keywords, template, json_content FROM `static_page` WHERE id=" . $id);
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
        $sql = "UPDATE static_page SET short_desc=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, json_content=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$short_desc, $post_title, $img, $status, $description, $title, $keywords, $json_content, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE static_page SET short_desc=?, post_title=?, img=?, status=?, description=?, title=?, keywords=?, json_content=? WHERE id=?";
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
