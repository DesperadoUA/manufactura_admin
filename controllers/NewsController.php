<?php

class NewsController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("news");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (News::deleteById($id)) {
                header('Location: /news/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('news', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['prevyu'] = $_POST['prevyu'];
                $json_content['img'] = "/template/images/prevyu_article.jpg";
                $data['data_field'] = $_POST['data_field'];

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

                if (News::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['data_field'], $data['direction_id'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = News::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'news');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = News::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'news');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
        }

        require_once(ROOT . '/views/news/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('news')) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['prevyu'] = $_POST['prevyu'];
                $data['data_field'] = $_POST['data_field'];

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

                $MAX_ID = SiteFunction::getLastId('news');
                if (News::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['data_field'], $data['lang'])) {
                    header('Location: /news/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }


        require_once(ROOT . '/views/news/add.php');
        return true;
    }
}
