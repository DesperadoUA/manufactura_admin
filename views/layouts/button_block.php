<div class="text-center">
    <?php if ($user_data['role'] != "User") {
        echo '<input type="submit" name="submit" value="Сохранить" class="btn_mm" /> <input type="submit" name="delete" value="Удалить" class="red_btn_mm delete_btn" /> <button class="btn_mm show_page" >Просмотреть запись</button>';
    }
    ?>
</div>