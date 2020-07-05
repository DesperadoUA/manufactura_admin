<?php

class PriceController
{
    const NAME_DB = 'price';
    const SLUG = 'price';
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
            if (Price::deleteById($id)) {
                header('Location: /' . self::SLUG . '/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        $data = Price::getDateById($id);
        $data = SiteFunction::getRelativPost($data, self::NAME_DB);
        $data_direction = SiteFunction::getUniqueRow('direction', $data['lang']);
        $data_services = SiteFunction::getUniqueRow('services', $data['lang']);
        require_once(ROOT . '/views/price/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {
            if (SiteFunction::addCommonData(self::NAME_DB)) {
                $data['json_content'] = [];
                $data['lang'] = $_POST['lang'];
                $MAX_ID = SiteFunction::getLastId(self::NAME_DB);
                if (Price::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['lang'])) {
                    header('Location: /' . self::SLUG . '/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/price/add.php');
        return true;
    }
}
