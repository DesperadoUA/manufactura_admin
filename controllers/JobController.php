<?php

class JobController
{
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("job");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';

        if (isset($_POST['delete'])) {
            if (Job::deleteById($id)) {
                header('Location: /job/all/');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }

        if (isset($_POST['submit'])) {
            if (SiteFunction::updateCommonData('job', $id)) {
                $result = "<p>Данные обновлены</p>";
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['prevyu'] = $_POST['prevyu'];
                $data['job_desc'] = $_POST['job_desc'];
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

                if (Job::edit($id, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['data_field'], $data['job_desc'])) {
                    $result = "<p>Данные обновлены</p>";
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }

                $data = Job::getDateById($id);
                $data = SiteFunction::getRelativPost($data, 'job');
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Job::getDateById($id);
            $data = SiteFunction::getRelativPost($data, 'job');
        }

        require_once(ROOT . '/views/job/editor.php');
        return true;
    }
    public function actionAdd()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {

            if (SiteFunction::addCommonData('job')) {
                $json_content['main_content'] = $_POST['main_content'];
                $json_content['prevyu'] = $_POST['prevyu'];
                $data['data_field'] = $_POST['data_field'];
                $data['job_desc'] = $_POST['job_desc'];

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
                $MAX_ID = SiteFunction::getLastId('job');
                if (Job::addNew($MAX_ID, json_encode($data['json_content'], JSON_UNESCAPED_UNICODE), $data['data_field'], $data['job_desc'], $data['lang'])) {
                    header('Location: /job/' . $MAX_ID);
                } else {
                    $result = "<p>Ошибка баз данных</p>";
                }
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        }
        require_once(ROOT . '/views/job/add.php');
        return true;
    }
}
