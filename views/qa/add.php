<?php
require_once(ROOT."/views/layouts/header.php");
?>
<main class="blog_edit_template">
<?php require_once(ROOT."/views/layouts/header_admin.php"); ?>
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-2 block_sitebar">
            <?php require_once(ROOT."/views/layouts/sitebar.php"); ?>   
            </div>
            <div class="col-lg-10 block_main">
                <h1>Добавить вопрос</h1>
                <?php require_once(ROOT."/views/layouts/global_meta_empty.php"); ?>           
        <div class="row">
            <div class="col-lg-1" >Текст вопроса</div>
            <div class="col-lg-11">
                <textarea name="text_1" class="summernote" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1" >Текст ответа</div>
            <div class="col-lg-11">
                <textarea name="text_2" class="summernote" required></textarea>
            </div>
        </div>
        <div class="text-center">
            <?php if($user_data['role']!="User")
                {
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
require_once(ROOT."/views/layouts/footer.php");
?>