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
                <h1>Редактирование направления</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
				<?php
				if(!array_key_exists('breadcrumbs', $data["json_content"])) $data["json_content"]['breadcrumbs'] = [];
				echo Module_2::getHtml($data["json_content"]['breadcrumbs'], 'breadcrumbs', 'Хлебные крошки');
				?>
                <div class="row">
                    <div class="col-lg-1">Баннер 1920x800</div>
                    <div class="col-lg-5">
                        <input type="file" name="img_banner" class="admin_input" />
                        <input type="text" name="defolt_img_banner" class="hide" value="<?php echo $data['json_content']['img']; ?>">
                    </div>
                    <div class="col-lg-6 block_img text-right">
                        <?php if ($data['json_content']['img'] != "0") {
                            echo "<img src='" . $data['json_content']['img'] . "'>";
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Описание под H1</div>
                    <div class="col-lg-11">
                        <textarea name="h1_desc" class="summernote"><?php echo $data['json_content']['h1_desc']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст возле видео</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Ссылка на видео</div>
                    <div class="col-lg-11">
                        <textarea name="video_link" class="video_link"><?php echo $data['json_content']['video_link']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Заголовок услуг</div>
                    <div class="col-lg-6">
                        <input type="text" name="title_services" class="admin_input" value="<?php if (array_key_exists('title_services', $data['json_content'])) echo $data['json_content']['title_services']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст 1</div>
                    <div class="col-lg-11">
                        <textarea name="simptomi" class="summernote"><?php echo $data['json_content']['simptomi']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Список 1</div>
                    <div class="col-lg-11">
                        <textarea name="service_list" class="video_link"><?php
                            if (array_key_exists('service_list', $data['json_content'])) echo $data['json_content']['service_list']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст 2</div>
                    <div class="col-lg-11">
                        <textarea name="simptomi_2" class="summernote"><?php
                                                                        if (array_key_exists('simptomi_2', $data['json_content'])) echo $data['json_content']['simptomi_2']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Список 2</div>
                    <div class="col-lg-11">
                        <textarea name="service_list_2" class="video_link"><?php
                                                                            if (array_key_exists('service_list_2', $data['json_content'])) echo $data['json_content']['service_list_2']; ?></textarea>
                    </div>
                </div>
                <?php // require_once(ROOT."/views/layouts/slider_img_edit.php"); 
                ?>
                <?php require_once(ROOT . '/views/layouts/button_block.php'); ?>
                </form>
                <div class="text_block"><?php echo $result; ?></div>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT . "/views/layouts/footer.php");
?>