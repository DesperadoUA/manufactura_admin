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
                <h1>Редактирование врача</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Фото врача</div>
                    <div class="col-lg-5">
                        <input type="file" name="img_doc" id="post_prevyu" class="admin_input" />
                        <input type="text" name="defolt_img_doc" id="post_prevyu_show" class="hide" value="<?php echo $data['json_content']['img']; ?>">
                    </div>
                    <div class="col-lg-6 block_img text-right">
                        <?php
                        if ($data['json_content']['img'] != "0") {
                            echo "<img src='" . $data['json_content']['img'] . "'>";
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Описание врача</div>
                    <div class="col-lg-5">
                        <input type="text" name="desc_doc" class="admin_input" value="<?php echo $data['desc_doc']; ?>" />
                    </div>
                    <div class="col-lg-1">Опыт работы</div>
                    <div class="col-lg-5">
                        <input type="text" name="expirience" class="admin_input" value="<?php echo $data['expirience']; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Основной текст</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Цена 1</div>
                    <div class="col-lg-5">
                        <input type="text" name="price_1" class="admin_input" value="<?php echo $data['json_content']['price_1']; ?>" />
                    </div>
                    <div class="col-lg-1">Цена 2</div>
                    <div class="col-lg-5">
                        <input type="text" name="price_2" class="admin_input" value="<?php echo $data['json_content']['price_2']; ?>" />
                    </div>
                </div>
                <?php
                require_once(ROOT . "/views/layouts/select_direction_multiple.php");
                require_once(ROOT . "/views/layouts/select_services.php");
                require_once(ROOT . "/views/layouts/slider_img_edit.php");
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