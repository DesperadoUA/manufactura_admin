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
                <h1>Редактирование услуг</h1>
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
                    <div class="col-lg-1">Основное содержимое</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Симптомы</div>
                    <div class="col-lg-11">
                        <textarea name="simptomi" class="summernote"><?php echo $data['json_content']['simptomi']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Последний текст</div>
                    <div class="col-lg-11">
                        <textarea name="last_text" class="summernote"><?php echo $data['json_content']['last_text']; ?></textarea>
                    </div>
                </div>
                <?php require_once(ROOT . "/views/layouts/select_direction.php"); ?>
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