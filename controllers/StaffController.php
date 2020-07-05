<?php

class StaffController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("staff");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['delete'])) {

            if (!Staff::deleteById(SiteFunction::getId(), $_POST['lang'])) {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {

            if (SiteFunction::updateCommonData('staff', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['price_1'] = $_POST['price_1'];
                $json_content['price_2'] = $_POST['price_2'];

                if ($_FILES['img_doc']['name']) {
                    $file_tmp = $_FILES['img_doc']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_doc']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_doc'];
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
                        } else {
                            $json_content['slider_img'][] = $_POST["defolt_slider_img"][$i];
                        }
                        $i++;
                    }
                } else {
                    $json_content['slider_img'] = 0;
                }

				if (array_key_exists('direction', $_POST)) {
					foreach ($_POST['direction'] as $item) {
						$data['direction_id'][] = "!" . $item . "!";
					}
					$data['direction_id'] = json_encode($data['direction_id']);
				} else {
					$data['direction_id'] = [];
					$data['direction_id'] = json_encode($data['direction_id']);
				}

                if (array_key_exists('services', $_POST)) {
                    foreach ($_POST['services'] as $item) {
                        $data['services_id'][] = "!" . $item . "!";
                    }
                    $data['services_id'] = json_encode($data['services_id']);
                } else {
                    $data['services_id'] = 0;
                }

                $data['desc_doc'] = $_POST['desc_doc'];
                $data['expirience'] = $_POST['expirience'];

                $data['json_content'] = $json_content;

                if (Staff::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['desc_doc'], $data['expirience'], $data['direction_id'], $data['services_id'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Staff::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'staff');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
                $data_services = SiteFunction::getUniqueRow('services', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Staff::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'staff');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            $data_services = SiteFunction::getUniqueRow('services', $data['lang']);
        }
        require_once(ROOT . '/views/staff/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('staff')) {
                $result = "<p>Данные обновлены</p>";

                $json_content['main_content'] = $_POST['main_content'];
                $json_content['price_1'] = $_POST['price_1'];
                $json_content['price_2'] = $_POST['price_2'];

                if ($_FILES['img_doc']['name']) {
                    $file_tmp = $_FILES['img_doc']['tmp_name'];
                    $file_name = "template/uploads/" . time() . $_FILES['img_doc']['name'];
                    $expensions = array('jpeg', "jpg", "png");
                    move_uploaded_file($file_tmp, $file_name);
                    $json_content['img'] = "/" . $file_name;
                } else {
                    $json_content['img'] = $_POST['defolt_img_doc'];
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
                $data['desc_doc'] = $_POST['desc_doc'];
                $data['expirience'] = $_POST['expirience'];
                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];

                $MAX_ID = SiteFunction::getLastId('staff');
                if (Staff::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['desc_doc'], $data['expirience'], $data['lang'])) {
                    header('Location: /post_staff/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/staff/add.php');
        return true;
    }
}
