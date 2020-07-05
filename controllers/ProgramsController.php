<?php

class ProgramsController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("programs");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['delete'])) {
            if (Programs::deleteById($id)) {
                header('Location: /programs/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('programs', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];

                $json_content['title_package_1'] = $_POST['title_package_1'];
                $json_content['desc_package_1'] = $_POST['desc_package_1'];
                $json_content['total_price_package_1'] = $_POST['total_price_package_1'];
                $json_content['first_price_package_1'] = $_POST['first_price_package_1'];
                $json_content['second_price_package_1'] = $_POST['second_price_package_1'];
                $json_content['desc_price_package_1'] = $_POST['desc_price_package_1'];

                $json_content['title_package_2'] = $_POST['title_package_2'];
                $json_content['desc_package_2'] = $_POST['desc_package_2'];
                $json_content['total_price_package_2'] = $_POST['total_price_package_2'];
                $json_content['first_price_package_2'] = $_POST['first_price_package_2'];
                $json_content['second_price_package_2'] = $_POST['second_price_package_2'];
                $json_content['desc_price_package_2'] = $_POST['desc_price_package_2'];

                $json_content['title_package_3'] = $_POST['title_package_3'];
                $json_content['desc_package_3'] = $_POST['desc_package_3'];
                $json_content['total_price_package_3'] = $_POST['total_price_package_3'];
                $json_content['first_price_package_3'] = $_POST['first_price_package_3'];
                $json_content['second_price_package_3'] = $_POST['second_price_package_3'];
                $json_content['desc_price_package_3'] = $_POST['desc_price_package_3'];

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
				if (array_key_exists('direction', $_POST)) {
					foreach ($_POST['direction'] as $item) {
						$data['direction_id'][] = "!" . $item . "!";
					}
					$data['direction_id'] = json_encode($data['direction_id']);
				} else {
					$data['direction_id'] = [];
					$data['direction_id'] = json_encode($data['direction_id']);
				}
                $data['tipe'] = $_POST['tipe'];
                $data['data_field'] = $_POST['data_field'];

                if (Programs::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE),
					$data['direction_id'], $data['data_field'], $data['tipe'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
                $data = Programs::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'programs');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Programs::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'programs');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
        }

        require_once(ROOT . '/views/programs/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('programs')) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['h1_desc'] = $_POST['h1_desc'];

                $json_content['title_package_1'] = $_POST['title_package_1'];
                $json_content['desc_package_1'] = $_POST['desc_package_1'];
                $json_content['total_price_package_1'] = $_POST['total_price_package_1'];
                $json_content['first_price_package_1'] = $_POST['first_price_package_1'];
                $json_content['second_price_package_1'] = $_POST['second_price_package_1'];
                $json_content['desc_price_package_1'] = $_POST['desc_price_package_1'];

                $json_content['title_package_2'] = $_POST['title_package_2'];
                $json_content['desc_package_2'] = $_POST['desc_package_2'];
                $json_content['total_price_package_2'] = $_POST['total_price_package_2'];
                $json_content['first_price_package_2'] = $_POST['first_price_package_2'];
                $json_content['second_price_package_2'] = $_POST['second_price_package_2'];
                $json_content['desc_price_package_2'] = $_POST['desc_price_package_2'];

                $json_content['title_package_3'] = $_POST['title_package_3'];
                $json_content['desc_package_3'] = $_POST['desc_package_3'];
                $json_content['total_price_package_3'] = $_POST['total_price_package_3'];
                $json_content['first_price_package_3'] = $_POST['first_price_package_3'];
                $json_content['second_price_package_3'] = $_POST['second_price_package_3'];
                $json_content['desc_price_package_3'] = $_POST['desc_price_package_3'];

                if ($_FILES['img_banner']['name']) {
                    $file_tmp = $_FILES['img_banner']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_banner']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_banner'];
                }
                $data['lang'] = $_POST['lang'];
                $data['json_content'] = $json_content;
                $data['tipe'] = $_POST['tipe'];
                $data['data_field'] = $_POST['data_field'];

                $MAX_ID = SiteFunction::getLastId('programs');
                if (Programs::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'], $data['data_field'], $data['tipe'])) {
                    header('Location: /programs/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }


        require_once(ROOT . '/views/programs/add.php');
        return true;
    }
}
