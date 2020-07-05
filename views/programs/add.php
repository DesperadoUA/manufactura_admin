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
                <h1>Добавить программу</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_empty.php"); ?>
                <div class="row">
                    <div class="col-lg-1">Баннер 1920x800</div>
                    <div class="col-lg-5">
                        <input type="file" name="img_banner" class="admin_input" />
                        <input type="text" name="defolt_img_banner" class="hide" value="/template/images/about.jpg">
                    </div>
                    <div class="col-lg-1">Тип</div>
                    <div class="col-lg-5">
                        <select class="admin_select" name="tipe">
                            <option>adult</option>
                            <option>children</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Поле описания</div>
                    <div class="col-lg-5">
                        <input type="text" name="data_field" class="admin_input" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Описание под h1</div>
                    <div class="col-lg-11">
                        <textarea name="h1_desc" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">Основное содержимое</div>
                    <div class="col-lg-11">
                        <textarea name="main_content" class="summernote"></textarea>
                    </div>
                </div>
                <div class="row programs_editor">
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 1</div>
                        <input type="text" name="title_package_1" class="admin_input" />
                        <div class="label">Описание пакет 1</div>
                        <textarea type="text" name="desc_package_1" class="summernote"></textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_1" class="admin_input" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_1" class="admin_input" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_1" class="admin_input" />
                        <div class="label">Описание цены 1</div>
                        <textarea type="text" name="desc_price_package_1" class="summernote"></textarea>
                    </div>
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 2</div>
                        <input type="text" name="title_package_2" class="admin_input" />
                        <div class="label">Описание пакет 2</div>
                        <textarea type="text" name="desc_package_2" class="summernote"></textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_2" class="admin_input" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_2" class="admin_input" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_2" class="admin_input" />
                        <div class="label">Описание цены 2</div>
                        <textarea type="text" name="desc_price_package_2" class="summernote"></textarea>
                    </div>
                    <div class="col-lg-4">
                        <div class="label">Заголовок пакет 3</div>
                        <input type="text" name="title_package_3" class="admin_input" />
                        <div class="label">Описание пакет 3</div>
                        <textarea type="text" name="desc_package_3" class="summernote">
                        </textarea>
                        <div class="label">Общая стоимость</div>
                        <input type="text" name="total_price_package_3" class="admin_input" />
                        <div class="label">Первая цена</div>
                        <input type="text" name="first_price_package_3" class="admin_input" />
                        <div class="label">Вторая цена</div>
                        <input type="text" name="second_price_package_3" class="admin_input" />
                        <div class="label">Описание цены 3</div>
                        <textarea type="text" name="desc_price_package_3" class="summernote"></textarea>
                    </div>
                </div>
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