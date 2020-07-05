<?php
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_2/Module_2.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_3/Module_3.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin_modules/module_4/Module_4.php';

class SettingsController
{
    const NAME_DB = 'settings';
    public function actionCategory()
    {
        $user_data = SiteFunction::checkLogin();
        $data = SiteFunction::getDataByArchiv("settings");
        require_once(ROOT . '/views/site/archiv.php');
        return true;
    }

    public function actionEditor()
    {
        $user_data = SiteFunction::checkLogin();
        $id = SiteFunction::getId();
        $result = '';
        if (isset($_POST['submit'])) {
            $data = Settings::getDataById($id);
            $data['post_title'] = $_POST['post_title'];
            if ($_FILES['img']['name']) {
                $file_tmp = $_FILES['img']['tmp_name'];
                $file_name = "template/uploads/" . time() . $_FILES['img']['name'];
                $expensions = array('jpeg', "jpg", "png");
                move_uploaded_file($file_tmp, $file_name);
                $data['img'] = "/" . $file_name;
            } else {
                $data['img'] = $_POST['defolt_img'];
            }
            $data['status'] = $_POST['status'];
            $data['description'] = $_POST['description'];
            $data['title'] = $_POST['title'];
            $data['keywords'] = $_POST['keywords'];
            $data['short_desc'] = $_POST['short_desc'];
            if($data['template'] === 'menu_1') {
                if (array_key_exists('menu_anchor', $_POST)) {
                    foreach ($_POST['menu_anchor'] as $item) $menu_anchor[] = $item;
                    $data['json_content']['menu_anchor'] = $menu_anchor;

                    foreach ($_POST['menu_link'] as $item) $menu_link[] = $item;
                    $data['json_content']['menu_link'] = $menu_link;
                } else {
                    $data['json_content'] = [];
                }
            }
            if($data['template'] === 'form') {
                if (array_key_exists('menu_anchor', $_POST)) {
                    foreach ($_POST['menu_anchor'] as $item) $menu_anchor[] = $item;
                    $data['json_content']['menu_anchor'] = $menu_anchor;

                    foreach ($_POST['menu_link'] as $item) $menu_link[] = $item;
                    $data['json_content']['menu_link'] = $menu_link;
                } else {
                    $data['json_content'] = [];
                }
            }
            if($data['template'] === 'footer_main_menu'){
                $data['json_content']['menu'] = Module_2::getData('menu');
            }
			if($data['template'] === 'footer_logos'){
				$data['json_content']['logos'] = Module_3::getData('logos');
			}
			if($data['template'] === 'emails'){
				$data['json_content']['emails'] = Module_4::getData();
			}
			if($data['template'] === 'redirects'){
				$data['json_content']['redirects'] = Module_2::getData('redirects');
			}
            if (Settings::edit(
                $data['short_desc'],
                $data['post_title'],
                $data['img'],
                $data['status'],
                $data['description'],
                $data['title'],
                $data['keywords'],
                json_encode($data['json_content']),
                $id
            )) {
            } else {
                $result = "<p>Ошибка баз данных</p>";
            }
        } else {
            $data = Settings::getDataById($id);
        }
        require_once(ROOT . '/views/settings/editor.php');
        return true;
    }
}
