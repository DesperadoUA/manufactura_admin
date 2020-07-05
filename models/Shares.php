<?php

class Shares
{
    public static function getDateById($id)
    {
        $data = SiteFunction::getCommonDataById('shares', $id);
        $db = Db::getConnection();
        $result = $db->query("SELECT 
            data_field, 
            direction_id, 
            services_id, 
            banner_direction, 
            banner_main, 
            banner_text_1, 
            banner_text_2, 
            banner_text_3, 
            banner_date,
            show_main_page, banner_link FROM `shares` WHERE id=" . $id);
        while ($row = $result->fetch()) {
            $data['data_field'] = $row['data_field'];
            $data['direction_id'] = $row['direction_id'];
            $data['banner_direction'] = $row['banner_direction'];
            $data['banner_main'] = $row['banner_main'];
            $data['services_id'] = $row['services_id'];
            $data['banner_text_1'] = $row['banner_text_1'];
            $data['banner_text_2'] = $row['banner_text_2'];
            $data['banner_text_3'] = $row['banner_text_3'];
            $data['banner_date'] = $row['banner_date'];
            $data['show_main_page'] = $row['show_main_page'];
            $data['banner_link'] = $row['banner_link'];
        }
        $data['services_id'] = json_decode(str_replace("!", "", $data['services_id']));
        $data['direction_id'] = json_decode(str_replace("!", "", $data['direction_id']));
        return $data;
    }

    public static function edit(
    	$id,
		$json_content,
		$data_field,
		$direction_id,
		$services_id,
		$banner_direction,
		$banner_main,
		$banner_text_1,
		$banner_text_2,
		$banner_text_3,
		$banner_date,
		$show_main_page,
		$banner_link)
    {
        $db = Db::getConnection();
        $sql = "UPDATE shares SET 
              json_content=?, 
              data_field=?, 
              direction_id=?, 
              services_id=?, 
              banner_direction=?, 
              banner_main=?, 
              banner_text_1=?, 
              banner_text_2=?, 
              banner_text_3=?, 
              banner_date=?, 
              show_main_page=?,
              banner_link=?
                 WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([
            $json_content, $data_field, $direction_id, $services_id,
            $banner_direction, $banner_main, $banner_text_1,
            $banner_text_2, $banner_text_3, $banner_date, $show_main_page, $banner_link, $id
        ]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE shares SET 
                    json_content=?, 
                    data_field=?, 
                    direction_id=?, 
                    services_id=?, 
                    banner_direction=?, 
                    banner_main=?, 
                    banner_text_1=?, 
                    banner_text_2=?, 
                    banner_text_3=?, 
                    banner_date=?, 
                    show_main_page=?,
                    banner_link=?
                      WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([
                $json_content, $data_field, $direction_id, $services_id,
                $banner_direction, $banner_main, $banner_text_1, $banner_text_2,
                $banner_text_3, $banner_date, $show_main_page, $banner_link, $id
            ]);
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
        $sql = "DELETE FROM shares WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "DELETE FROM shares WHERE id=?";
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
    public static function addNew($id, $json_content, $data_field, $lang)
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
        $sql = "UPDATE shares SET json_content=?, data_field=?, `$lang_field`=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute([$json_content, $data_field, $id, $id]);
        if ($result->errorCode() == "00000") {
            $db = Db::getConnectionFront();
            $sql = "UPDATE shares SET json_content=?, data_field=?, `$lang_field`=? WHERE id=?";
            $result = $db->prepare($sql);
            $result->execute([$json_content, $data_field, $id, $id]);
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
