<?php

class QaController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("qa");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (Qa::deleteById($id)) {
                header('Location: /qa/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('qa', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['text_1'] = $_POST['text_1'];
                $json_content['text_2'] = $_POST['text_2'];
                $data['json_content'] = $json_content;

                if (array_key_exists('direction', $_POST)) {
                    $data['direction_id'] = $_POST['direction'][0];
                } else {
                    $data['direction_id'] = 0;
                }

                if (Qa::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['direction_id'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Qa::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'qa');
                $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Qa::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'qa');
            $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
        }

        require_once(ROOT . '/views/qa/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('qa')) {
                $result = "<p>Данные обновлены</p>";
                $json_content['text_1'] = $_POST['text_1'];
                $json_content['text_2'] = $_POST['text_2'];
                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];
                $MAX_ID = SiteFunction::getLastId('qa');
                if (Qa::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /qa/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/qa/add.php');
        return true;
    }
}
