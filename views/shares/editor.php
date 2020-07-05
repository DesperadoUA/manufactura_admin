<?php
require_once(ROOT . "/views/layouts/header.php");
?>
<main class="blog_edit_template">
    <?php require_once(ROOT . "/views/layouts/header_admin.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 block_sitebar">
                <?php require_once(ROOT . "/views/layouts/sitebar.php"); ?>
            </div>
            <div class="col-lg-10 block_main">
                <h1>Редактирование акций</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
				<?php
				if(!array_key_exists('banner_link', $data)) $data['banner_link'] = "";
				echo Module_5::getHtml($data['banner_link'], 'banner_link', 'Ссылка на главной странице');
				if(!array_key_exists('img', $data['json_content'])) $data['json_content']['img'] = "";
				echo Module_6::getHtml($data['json_content']['img'], 'img', 'Баннер 1920x800');
				?>
                <div class="row">
                    <div class="col-lg-1">Дата публикации</div>
                    <div class="col-lg-11">
                        <input type="text" name="data_field" class="admin_input" required value="<?php echo $data['data_field']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Основной текст</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Баннер для направлений</div>
                    <div class="col-lg-5">
                        <input type="file" name="banner_direction" class="admin_input" />
                        <input type="text" name="defolt_banner_direction" class="hide" value="<?php echo $data['banner_direction']; ?>">
                    </div>
                    <div class="col-lg-6 block_img text-right">
                        <?php if ($data['banner_direction'] != "0") {
                            echo "<img src='" . $data['banner_direction'] . "'>";
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Баннер главной страницы</div>
                    <div class="col-lg-5">
                        <input type="file" name="banner_main" class="admin_input" />
                        <input type="text" name="defolt_banner_main" class="hide" value="<?php echo $data['banner_main']; ?>">
                    </div>
                    <div class="col-lg-6 block_img text-right">
                        <?php if ($data['banner_main'] != "0") {
                            echo "<img src='" . $data['banner_main'] . "'>";
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Баннер текст 1</div>
                    <div class="col-lg-5">
                        <input type="text" name="banner_text_1" class="admin_input" value="<?php echo $data['banner_text_1']; ?>" />
                    </div>
                    <div class="col-lg-1">Баннер текст 2</div>
                    <div class="col-lg-5">
                        <input type="text" name="banner_text_2" class="admin_input" value="<?php echo $data['banner_text_2']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Баннер текст 3</div>
                    <div class="col-lg-5">
                        <input type="text" name="banner_text_3" class="admin_input" value="<?php echo $data['banner_text_3']; ?>" />
                    </div>
                    <div class="col-lg-1">Дата</div>
                    <div class="col-lg-5">
                        <input type="date" name="banner_date" class="admin_input" required value="<?php echo $data['banner_date']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">
                        Отображать баннер на главной
                    </div>
                    <div class="col-lg-5">
                        <input type='checkbox' <?php
                                                if (array_key_exists('show_main_page', $data) and  $data['show_main_page']) echo "checked";
                                                ?> name='show_main_page'>
                    </div>
                </div>
                <?php
                require_once(ROOT . "/views/layouts/select_direction_multiple.php");
                require_once(ROOT . "/views/layouts/select_services.php");
                require_once(ROOT . '/views/layouts/button_block.php');
                ?>
                </form>
                <div class="text_block"><?php echo $result; ?></div>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT . "/views/layouts/footer.php");
?>