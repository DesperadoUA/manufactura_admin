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
            <div class="col-lg-10 block_main <?php if ($data['template'] === 'price') echo "price_template"; ?>">
                <h1>Редактирование <?php echo $data['post_title']; ?></h1>
                <?php require_once(ROOT . "/views/layouts/global_static_page.php"); ?>
                <?php
                if ($data['template'] === 'contact') require_once(ROOT . "/views/site/static_templates/contact.php");
                if ($data['template'] === 'main') require_once(ROOT . "/views/site/static_templates/main_page.php");
                if ($data['template'] === 'about') require_once(ROOT . "/views/site/static_templates/about.php");
                if ($data['template'] === 'partners') require_once(ROOT . "/views/site/static_templates/partners.php");
                if ($data['template'] === 'medical_books') require_once(ROOT . "/views/site/static_templates/examinations.php");
                if ($data['template'] === 'medical-information') require_once(ROOT . "/views/site/static_templates/examinations.php");
                if ($data['template'] === 'examination_employee') require_once(ROOT . "/views/site/static_templates/examinations.php");
                if ($data['template'] === 'price') require_once(ROOT . "/views/site/static_templates/price.php");
                ?>
                <?php require_once(ROOT . '/views/layouts/static_button_block.php'); ?>
                <div class="text_block"><?php echo $result; ?></div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT . "/views/layouts/footer.php");
?>