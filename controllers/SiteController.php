<?php

include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_1/Module_1.php';

class SiteController
{
    public function actionAdmin()
    {
        $user_data = SiteFunction::checkLogin();
        require_once(ROOT . "/views/site/admin.php");
        return true;
    }

    public function actionStaticpage()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchivStaticPage();
        require_once(ROOT . '/views/site/static_archive.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {
            $data = StaticPage::getDataById($id);
            $data['post_title'] = $_POST['post_title'];
            if ($_FILES['img']['name']) {
                $file_tmp = $_FILES['img']['tmp_name'];
                $file_name = "template/uploads/" . time() . $_FILES['img']['name'];
                $expensions = array('jpeg', "jpg", "png");
                move_uploaded_file($file_tmp, $file_name);
                $data['img'] = "/" . $file_name;
            } else {
                $data['img'] = $_POST['defolt_img'];
            }
            $data['status'] = $_POST['status'];
            $data['description'] = $_POST['description'];
            $data['title'] = $_POST['title'];
            $data['keywords'] = $_POST['keywords'];
            $data['short_desc'] = $_POST['short_desc'];

            if ($data['template'] === 'contact') {
                $data['json_content']['text_left'] = $_POST['text_left'];
                $data['json_content']['text_right'] = $_POST['text_right'];
                $data['json_content']['main_content'] = $_POST['main_content'];
            }
            if ($data['template'] === 'main') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['pluses'] = Module_1::getData();
            }
            if ($data['template'] === 'about') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['h1_desc'] = $_POST['h1_desc'];
                $data['json_content']['title_service_global'] = $_POST['title_service_global'];
                $data['json_content']['title_service_1'] = $_POST['title_service_1'];
                $data['json_content']['title_service_2'] = $_POST['title_service_2'];
                $data['json_content']['title_service_3'] = $_POST['title_service_3'];
                $data['json_content']['title_service_4'] = $_POST['title_service_4'];
                $data['json_content']['desc_service_1'] = $_POST['desc_service_1'];
                $data['json_content']['desc_service_2'] = $_POST['desc_service_2'];
                $data['json_content']['desc_service_3'] = $_POST['desc_service_3'];
                $data['json_content']['desc_service_4'] = $_POST['desc_service_4'];
                $data['json_content']['title_button_1'] = $_POST['title_button_1'];
                $data['json_content']['title_button_2'] = $_POST['title_button_2'];
                $data['json_content']['title_button_3'] = $_POST['title_button_3'];
                $data['json_content']['title_button_4'] = $_POST['title_button_4'];
                $data['json_content']['link_button_1'] = $_POST['link_button_1'];
                $data['json_content']['link_button_2'] = $_POST['link_button_2'];
                $data['json_content']['link_button_3'] = $_POST['link_button_3'];
                $data['json_content']['link_button_4'] = $_POST['link_button_4'];
            }
            if ($data['template'] === 'partners') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['h1_desc'] = $_POST['h1_desc'];
                $data['json_content']['last_text'] = $_POST['last_text'];
            }
            if ($data['template'] === 'medical_books') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['h1_desc'] = $_POST['h1_desc'];
                $data['json_content']['last_text'] = $_POST['last_text'];
                if (array_key_exists('slider_img', $_FILES)) {
                    $i = 0;
                    foreach ($_FILES['slider_img']['name'] as $item) {
                        if ($item != "") {
                            $file_tmp = $_FILES['slider_img']['tmp_name'][$i];
                            $file_name = "template/uploads/" . time() . $item;
                            $expensions = array('jpeg', "jpg", "png");
                            move_uploaded_file($file_tmp, $file_name);
                            $json_content['slider_img'][] = "/" . $file_name;
                        } else {
                            $json_content['slider_img'][] = $_POST["defolt_slider_img"][$i];
                        }
                        $i++;
                    }
                } else {
                    $json_content['slider_img'] = 0;
                }
                $data['json_content']['slider_img'] = $json_content['slider_img'];
            }
            if ($data['template'] === 'medical-information') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['h1_desc'] = $_POST['h1_desc'];
                $data['json_content']['last_text'] = $_POST['last_text'];
                if (array_key_exists('slider_img', $_FILES)) {
                    $i = 0;
                    foreach ($_FILES['slider_img']['name'] as $item) {
                        if ($item != "") {
                            $file_tmp = $_FILES['slider_img']['tmp_name'][$i];
                            $file_name = "template/uploads/" . time() . $item;
                            $expensions = array('jpeg', "jpg", "png");
                            move_uploaded_file($file_tmp, $file_name);
                            $json_content['slider_img'][] = "/" . $file_name;
                        } else {
                            $json_content['slider_img'][] = $_POST["defolt_slider_img"][$i];
                        }
                        $i++;
                    }
                } else {
                    $json_content['slider_img'] = 0;
                }
                $data['json_content']['slider_img'] = $json_content['slider_img'];
            }
            if ($data['template'] === 'examination_employee') {
                $data['json_content']['main_content'] = $_POST['main_content'];
                $data['json_content']['h1_desc'] = $_POST['h1_desc'];
                $data['json_content']['last_text'] = $_POST['last_text'];
                if (array_key_exists('slider_img', $_FILES)) {
                    $i = 0;
                    foreach ($_FILES['slider_img']['name'] as $item) {
                        if ($item != "") {
                            $file_tmp = $_FILES['slider_img']['tmp_name'][$i];
                            $file_name = "template/uploads/" . time() . $item;
                            $expensions = array('jpeg', "jpg", "png");
                            move_uploaded_file($file_tmp, $file_name);
                            $json_content['slider_img'][] = "/" . $file_name;
                        } else {
                            $json_content['slider_img'][] = $_POST["defolt_slider_img"][$i];
                        }
                        $i++;
                    }
                } else {
                    $json_content['slider_img'] = 0;
                }
                $data['json_content']['slider_img'] = $json_content['slider_img'];
            }
            if (StaticPage::edit(
                $data['short_desc'],
                $data['post_title'],
                $data['img'],
                $data['status'],
                $data['description'],
                $data['title'],
                $data['keywords'],
                json_encode($data['json_content'], JSON_UNESCAPED_UNICODE),
                $id
            )) {
                $result = "<p>Данные обновлены </p>";
            } else {
                $result = "<p>Ошибка баз данных Фронт</p>";
            }
        } else {
            $data = StaticPage::getDataById($id);
        }
        require_once(ROOT . '/views/site/main_edit.php');
        return true;
    }
}
