<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_2/Module_2.php';
class DirectionController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("direction");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['delete'])) {
            if (!Direction::deleteById(SiteFunction::getId(), $_POST['lang'])) {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('direction', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];
                $json_content['simptomi'] = $_POST['simptomi'];
                $json_content['simptomi_2'] = trim($_POST['simptomi_2']);
                $json_content['video_link'] = $_POST['video_link'];
                $json_content['service_list'] = trim($_POST['service_list']);
                $json_content['service_list_2'] = $_POST['service_list_2'];
                $json_content['title_services'] = $_POST['title_services'];
				$json_content['breadcrumbs'] = Module_2::getData('breadcrumbs');

                if ($_FILES['img_banner']['name']) {
                    $file_tmp = $_FILES['img_banner']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_banner']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_banner'];
                }
                $data['json_content'] = $json_content;
                if (Direction::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE))) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Direction::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'direction');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        else {
            $data = Direction::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'direction');
        }
        
        require_once(ROOT . '/views/direction/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('direction')) {

                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];
                $json_content['simptomi'] = $_POST['simptomi'];
                $json_content['simptomi_2'] = $_POST['simptomi_2'];
                $json_content['video_link'] = $_POST['video_link'];
                $json_content['service_list'] = $_POST['service_list'];
                $json_content['service_list_2'] = $_POST['service_list_2'];
                $json_content['title_services'] = $_POST['title_services'];

                if ($_FILES['img_banner']['name']) {
                    $file_tmp = $_FILES['img_banner']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_banner']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_banner'];
                }

                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];

                $MAX_ID = SiteFunction::getLastId('direction');
                if (Direction::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /direction/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/direction/add.php');
        return true;
    }
}
