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
                <h1>Редактирование программ</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Баннер 1920x800</div>
                    <div class="col-lg-5">
                        <input type="file" name="img_banner" class="admin_input" />
                        <input type="text" name="defolt_img_banner" class="hide"
                               value="<?= $data['json_content']['img']; ?>">
                    </div>
                    <div class="col-lg-6 block_img text-right">
                        <?php if ($data['json_content']['img'] != "0") {
                            echo "<img src='" . $data['json_content']['img'] . "'>";
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Описание под h1</div>
                    <div class="col-lg-11">
                        <textarea name="h1_desc" class="summernote">
                            <?= $data['json_content']['h1_desc']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Тип</div>
                    <div class="col-lg-5">
                        <select class="admin_select" name="tipe" id="lang_select">
                            <?php
                            echo "<option>" . $data['tipe'] . "</option>";
                            if ($data['tipe'] === "adult") echo "<option>children</option>";
                            else echo "<option>adult</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-1">Поле описания</div>
                    <div class="col-lg-5">
                        <input type="text" name="data_field" class="admin_input"
                               value="<?= $data['data_field']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Основное содержимое</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote">
                            <?= $data['json_content']['main_content']; ?></textarea>
                    </div>
                </div>
                <div class="row programs_editor">
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 1</div>
                        <input type="text" name="title_package_1" class="admin_input"
                               value="<?= $data['json_content']['title_package_1']; ?>" />
                        <div class="label">Описание пакет 1</div>
                        <textarea type="text" name="desc_package_1" class="summernote">
                            <?= $data['json_content']['desc_package_1']; ?>
                        </textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_1" class="admin_input"
                               value="<?= $data['json_content']['total_price_package_1']; ?>" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_1" class="admin_input"
                               value="<?= $data['json_content']['first_price_package_1']; ?>" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_1" class="admin_input"
                               value="<?= $data['json_content']['second_price_package_1']; ?>" />
                        <div class="label">Описание цены 1</div>
                        <textarea type="text" name="desc_price_package_1" class="summernote">
                            <?= $data['json_content']['desc_price_package_1']; ?>
                        </textarea>
                    </div>
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 2</div>
                        <input type="text" name="title_package_2" class="admin_input"
                               value="<?= $data['json_content']['title_package_2']; ?>" />
                        <div class="label">Описание пакет 2</div>
                        <textarea type="text" name="desc_package_2" class="summernote">
                            <?= $data['json_content']['desc_package_2']; ?>
                        </textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_2" class="admin_input"
                               value="<?= $data['json_content']['total_price_package_2']; ?>" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_2" class="admin_input"
                               value="<?= $data['json_content']['first_price_package_2']; ?>" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_2" class="admin_input"
                               value="<?= $data['json_content']['second_price_package_2']; ?>" />
                        <div class="label">Описание цены 2</div>
                        <textarea type="text" name="desc_price_package_2" class="summernote">
                            <?= $data['json_content']['desc_price_package_2']; ?>
                        </textarea>
                    </div>
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 3</div>
                        <input type="text" name="title_package_3" class="admin_input"
                               value="<?= $data['json_content']['title_package_3']; ?>" />
                        <div class="label">Описание пакет 3</div>
                        <textarea type="text" name="desc_package_3" class="summernote">
                            <?= $data['json_content']['desc_package_3']; ?>
                        </textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_3" class="admin_input"
                               value="<?= $data['json_content']['total_price_package_3']; ?>" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_3" class="admin_input"
                               value="<?= $data['json_content']['first_price_package_3']; ?>" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_3" class="admin_input"
                               value="<?= $data['json_content']['second_price_package_3']; ?>" />
                        <div class="label">Описание цены 3</div>
                        <textarea type="text" name="desc_price_package_3" class="summernote">
                            <?= $data['json_content']['desc_price_package_3']; ?>
                        </textarea>
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