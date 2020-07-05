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
                <h1>Регистрация пользователя</h1>
                <form method="post" action="" class="register_form">
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="text" name="login" placeholder="Login" class="input_mm" value="<?php echo $login; ?>">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="password" placeholder="Password" class="input_mm" value="<?php echo $password; ?>">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="mail" placeholder="Email" class="input_mm" value="<?php echo $mail; ?>">
                        </div>
                        <div class="col-lg-3">
                            <select name="role" class="select_mm">
                                <option>User</option>
                                <option>Editor</option>
                            </select>
                        </div>
                        <div class="col-lg-12 text-center">
                            <input type="submit" name="submit" value="Добавить пользователя" class="submite_mm">
                        </div>
                    </div>
                </form>
                <div class="text_block">
                    <?php     
                        for($i=0; $i<count($error); $i++)
                        {
                            echo "<p>".$error[$i]."</p>";
                        } 
                        echo $db_result;
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT."/views/layouts/footer.php");
?>