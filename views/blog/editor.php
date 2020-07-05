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
                <h1>Редактирование блога</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Картинка 240x384</div>
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
                    <div class="col-lg-1">Дата публикации</div>
                    <div class="col-lg-11">
                        <input type="text" name="data_field" class="admin_input" value="<?php echo $data['data_field']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Автор</div>
                    <div class="col-lg-11">
                        <input type="text" name="author" class="admin_input" value="<?php echo $data['author']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Основной текст</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Превью</div>
                    <div class="col-lg-11">
                        <textarea name="prevyu" class="summernote"><?php echo $data['json_content']['prevyu']; ?></textarea>
                    </div>
                </div>
                <?php require_once(ROOT . "/views/layouts/select_direction_multiple.php"); ?>
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