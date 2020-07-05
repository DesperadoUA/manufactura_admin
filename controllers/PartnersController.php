<?php

class PartnersController
{
    const NAME_DB = 'partners';
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv(self::NAME_DB);
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }
    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (Partners::deleteById($id)) {
                header('Location: /partners/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData(self::NAME_DB, $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;

                if (Partners::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE))) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
                $data = SiteFunction::getCommonDataById(self::NAME_DB, $id);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = SiteFunction::getCommonDataById(self::NAME_DB, $id);
        }

        require_once(ROOT . '/views/partners/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData(self::NAME_DB)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                $data['lang'] = $_POST['lang'];

                $MAX_ID = SiteFunction::getLastId(self::NAME_DB);
                if (Partners::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /partners/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/partners/add.php');
        return true;
    }
}
