<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_5/Module_5.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_6/Module_6.php';
class SharesController
{
	const DEFAULT_IMG_PATH = '/template/images/shares_default.jpg';
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("shares");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (Shares::deleteById(SiteFunction::getId())) {
                header('Location: /shares/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('shares', $id)) {
                $result = "<p>Данные обновлены Общие</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                $data['data_field'] = $_POST['data_field'];
				$data['banner_link'] = Module_5::getData('banner_link');
				$data['json_content']['img'] = Module_6::getData('img');
				if($data['json_content']['img'] === "") {
					$data['json_content']['img'] = self::DEFAULT_IMG_PATH;
				}

                if (array_key_exists('show_main_page', $_POST)) $data['show_main_page'] = true;
                else $data['show_main_page'] = false;

                if (array_key_exists('direction', $_POST)) {
                    foreach ($_POST['direction'] as $item) {
                        $data['direction_id'][] = "!" . $item . "!";
                    }
                    $data['direction_id'] = json_encode($data['direction_id']);
                }
                else {
                    $data['direction_id'] = [];
                    $data['direction_id'] = json_encode($data['direction_id']);
                }

                if ($_FILES['banner_direction']['name']) {
                    $file_tmp = $_FILES['banner_direction']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['banner_direction']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $data['banner_direction'] = "/" . $file_name;
                }
                else {
                    $data['banner_direction'] = $_POST['defolt_banner_direction'];
                }

                if ($_FILES['banner_main']['name']) {
                    $file_tmp = $_FILES['banner_main']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['banner_main']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $data['banner_main'] = "/" . $file_name;
                }
                else {
                    $data['banner_main'] = $_POST['defolt_banner_main'];
                }

                if (array_key_exists('services', $_POST)) {
                    foreach ($_POST['services'] as $item) {
                        $data['services_id'][] = "!" . $item . "!";
                    }
                    $data['services_id'] = json_encode($data['services_id']);
                }
                else {
                    $data['services_id'] = 0;
                }

                $data['banner_text_1'] = $_POST['banner_text_1'];
                $data['banner_text_2'] = $_POST['banner_text_2'];
                $data['banner_text_3'] = $_POST['banner_text_3'];
                $data['banner_date'] = $_POST['banner_date'];

                if (Shares::edit($id,
						json_encode($data['json_content'], JSON_UNESCAPED_UNICODE),
					    $data['data_field'],
					    $data['direction_id'],
					    $data['services_id'],
					    $data['banner_direction'],
					    $data['banner_main'],
					    $data['banner_text_1'],
					    $data['banner_text_2'],
					    $data['banner_text_3'],
					    $data['banner_date'],
					    $data['show_main_page'],
						$data['banner_link']
					)) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных Фронт</p>";
                }

                $data = Shares::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'shares');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
                $data_services = SiteFunction::getUniqueRow('services', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Shares::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'shares');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            $data_services = SiteFunction::getUniqueRow('services', $data['lang']);
        }
        require_once(ROOT . '/views/shares/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('shares')) {

                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                $data['data_field'] = $_POST['data_field'];
                $data['lang'] = $_POST['lang'];
                $MAX_ID = SiteFunction::getLastId('shares');

                if (Shares::addNew($MAX_ID,
					json_encode($data['json_content'], JSON_UNESCAPED_UNICODE),
					$data['data_field'],
					$data['lang']))
                {
                    header('Location: /shares/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/shares/add.php');
        return true;
    }
}
