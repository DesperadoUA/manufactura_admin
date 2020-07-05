<?php
require_once(ROOT."/views/layouts/header.php");
?>
<main class="main_page_template">
    <div class="container_form">
        <form class="login_form" method="post" action="">
            <h2>Login form</h2>
            <div class="inputBox"><input type="text"
                                         name="login"
                                         placeholder="Login"
                                         class="input_mm"
                                         value="<?php echo $login; ?>"></div>
            <div class="inputBox"><input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="input_mm inputBox"
                        value="<?php echo $password; ?>" ></div>
            <input type="submit" name="submit" value="Login" class="submite_mm">
            <div class="error_block"><?php echo $error; ?></div>
        </form>
    </div>
</main>
<?php
require_once(ROOT."/views/layouts/footer.php");
?>