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
                <h1>Добавить направление</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_empty.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Баннер 1920x800</div>
                    <div class="col-lg-5">
                        <input type="file" name="img_banner" class="admin_input" />
                        <input type="text" name="defolt_img_banner" class="hide" value="/template/images/about.jpg">
                    </div>
                    <div class="col-lg-6 block_img text-right">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Описание под H1</div>
                    <div class="col-lg-11">
                        <textarea name="h1_desc" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст возле видео</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Ссылка на видео</div>
                    <div class="col-lg-11">
                        <textarea name="video_link" class="video_link"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Заголовок услуг</div>
                    <div class="col-lg-6">
                        <input type="text" name="title_services" class="admin_input" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст 1</div>
                    <div class="col-lg-11">
                        <textarea name="simptomi" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Список 1</div>
                    <div class="col-lg-11">
                        <textarea name="service_list" class="video_link"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Текст 2</div>
                    <div class="col-lg-11">
                        <textarea name="simptomi_2" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Список 2</div>
                    <div class="col-lg-11">
                        <textarea name="service_list_2" class="video_link"></textarea>
                    </div>
                </div>
                <?php // require_once(ROOT."/views/layouts/slider_img_add.php"); 
                ?>
                <div class="text-center">
                    <?php if ($user_data['role'] != "User") {
                        echo '<input type="submit" name="submit" value="Добавить" class="submite_mm" />';
                    }
                    ?>
                </div>
                </form>
                <div class="text_block"><?php echo $result; ?></div>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT . "/views/layouts/footer.php");
?>