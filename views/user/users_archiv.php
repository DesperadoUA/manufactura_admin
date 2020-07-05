<?php
require_once(ROOT."/views/layouts/header.php");
?>
<main class="user_register_template">
<?php require_once(ROOT."/views/layouts/header_admin.php"); ?>
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-2 block_sitebar">
            <?php require_once(ROOT."/views/layouts/sitebar.php"); ?>   
            </div>
            <div class="col-lg-10 block_main">
                <h1>Список пользователей</h1>
                <?php 
                    for($i=0; $i<count($data); $i++)
                    {
                       echo "<div class='title_item'>".$data[$i]['login']."<a href='/user/".$data[$i]['id']."/'>Редактировать</a></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT."/views/layouts/footer.php");
?>