<?php
require_once(ROOT . "/views/layouts/header.php");
?>
<main class="blog_edit_template price_edit">
    <?php require_once(ROOT . "/views/layouts/header_admin.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 block_sitebar">
                <?php require_once(ROOT . "/views/layouts/sitebar.php"); ?>
            </div>
            <div class="col-lg-10 block_main">
                <h1>Редактирование прайса</h1>
                <?php require_once(ROOT . "/views/layouts/global_meta_data.php"); ?>
                <?php require_once(ROOT . "/views/site/static_templates/price_accordeon.php"); ?>
                <div class="text-center">
                    <input type="submit" name="delete" value="Удалить" class="red_btn_mm delete_btn">
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