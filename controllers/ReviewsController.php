<?php

class ReviewsController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("reviews");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (Reviews::deleteById($id)) {
                header('Location: /reviews/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('reviews', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                if (array_key_exists('direction', $_POST)) {
                    $data['direction_id'] = $_POST['direction'][0];
                } else {
                    $data['direction_id'] = 0;
                }
                if (array_key_exists('staff', $_POST)) {
                    $data['staff_id'] = $_POST['staff'][0];
                } else {
                    $data['staff_id'] = 0;
                }

                if (Reviews::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['direction_id'], $data['staff_id'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Reviews::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'reviews');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
                $data_staff = SiteFunction::getUniqueRow('staff', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Reviews::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'reviews');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            $data_staff = SiteFunction::getUniqueRow('staff', $data['lang']);
        }

        require_once(ROOT . '/views/reviews/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('reviews')) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];
                $MAX_ID = SiteFunction::getLastId('reviews');
                if (Reviews::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /reviews/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/reviews/add.php');
        return true;
    }
}
