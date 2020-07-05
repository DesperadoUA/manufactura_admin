<?php
require_once(ROOT . "/views/layouts/header.php");
?>
<main class="blog_edit_template partners_template">
    <?php require_once(ROOT . "/views/layouts/header_admin.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 block_sitebar">
                <?php require_once(ROOT . "/views/layouts/sitebar.php"); ?>
            </div>
            <div class="col-lg-10 block_main">
                <h1>Редактирование профосмотра</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Основной текст</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"><?php echo $data['json_content']['main_content']; ?></textarea>
                    </div>
                    <div class="col-lg-1">Тип профосмотра</div>
                    <div class="col-lg-5">
                        <select name="type" class="admin_select">
                            <?php
                            if ($data['type'] === 'medical_books') {
                                echo "<option>Медицинские книжки</option>
                                <option>Медицинские справки</option>
                                <option>Профосмотры сотрудников</option>";
                            }
                            if ($data['type'] === 'medical_information') {
                                echo "<option>Медицинские справки</option>
                                <option>Медицинские книжки</option>
                                <option>Профосмотры сотрудников</option>";
                            }
                            if ($data['type'] === 'examination_employee') {
                                echo "<option>Профосмотры сотрудников</option>
                                <option>Медицинские справки</option>
                                <option>Медицинские книжки</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
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