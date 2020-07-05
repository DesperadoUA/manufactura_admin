<?php

class ExaminationController
{
    const NAME_DB = 'examination';
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
            if (Examination::deleteById($id)) {
                header('Location: /examination/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData(self::NAME_DB, $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $data['json_content'] = $json_content;
                $data['type'] = $_POST['type'];
                if ($data['type'] === 'Медицинские книжки') $data['type'] = 'medical_books';
                if ($data['type'] === 'Медицинские справки') $data['type'] = 'medical_information';
                if ($data['type'] === 'Профосмотры сотрудников') $data['type'] = 'examination_employee';
                if (Examination::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['type'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
                $data = Examination::getDateById($id);
                $data = SiteFunction::getRelativPost($data, self::NAME_DB);
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Examination::getDateById($id);
            $data = SiteFunction::getRelativPost($data, self::NAME_DB);
        }

        require_once(ROOT . '/views/examination/editor.php');
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
                $data['type'] = $_POST['type'];
                if ($data['type'] === 'Медицинские книжки') $data['type'] = 'medical_books';
                if ($data['type'] === 'Медицинские справки') $data['type'] = 'medical_information';
                if ($data['type'] === 'Профосмотры сотрудников') $data['type'] = 'examination_employee';
                $MAX_ID = SiteFunction::getLastId(self::NAME_DB);
                if (Examination::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['type'], $data['lang'])) {
                    header('Location: /examination/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/examination/add.php');
        return true;
    }
}
