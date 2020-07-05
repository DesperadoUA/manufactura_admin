<?php require_once(ROOT . "/views/layouts/header.php"); ?>
<main class="blog_edit_template settings_template">
    <?php require_once(ROOT . "/views/layouts/header_admin.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 block_sitebar">
                <?php require_once(ROOT . "/views/layouts/sitebar.php"); ?>
            </div>
            <div class="col-lg-10 block_main">
                <h1>Редактирование</h1>
                <?php
                require_once(ROOT . "/views/layouts/global_static_page.php");
                require_once(ROOT . "/views/settings/static_template/" . $data['template'] . '.php');
                if ($data['template'] !== 'menu_main') require_once(ROOT . '/views/layouts/button_block.php');
                ?>
                </form>
                <div class="text_block"><?php echo $result; ?></div>
            </div>
        </div>
    </div>
</main>
<?php require_once(ROOT . "/views/layouts/footer.php"); ?>