<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_2/Module_2.php';
class ServicesController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("services");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (!Services::deleteById(SiteFunction::getId(), $_POST['lang'])) {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('services', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];
                $json_content['simptomi'] = $_POST['simptomi'];
                $json_content['last_text'] = $_POST['last_text'];
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

                if (array_key_exists('direction', $_POST)) {
                    $data['direction_id'] = $_POST['direction'][0];
                } else {
                    $data['direction_id'] = 0;
                }

                $data['json_content'] = $json_content;

                if (Services::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['direction_id'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Services::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'services');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Services::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'services');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
        }
        require_once(ROOT . '/views/services/editor.php');
        return true;
    }

    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('services')) {

                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];
                $json_content['simptomi'] = $_POST['simptomi'];
                $json_content['last_text'] = $_POST['last_text'];

                if ($_FILES['img_banner']['name']) {
                    $file_tmp = $_FILES['img_banner']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_banner']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_banner'];
                }

                if (array_key_exists('slider_img', $_FILES)) {
                    $i = 0;
                    foreach ($_FILES['slider_img']['name'] as $item) {
                        if ($item != "") {
                            $file_tmp = $_FILES['slider_img']['tmp_name'][$i];
                            $file_name = "template/uploads/" . time() . $item;
                            $expensions = array('jpeg', "jpg", "png");
                            move_uploaded_file($file_tmp, $file_name);
                            $json_content['slider_img'][] = "/" . $file_name;
                        }
                        $i++;
                    }
                } else {
                    $json_content['slider_img'] = 0;
                }

                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];

                $MAX_ID = SiteFunction::getLastId('services');
                if (Services::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /services/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/services/add.php');
        return true;
    }
}
