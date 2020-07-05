<div class="sitebar_box">
    <h2>Разделы сайта</h2>
    <div class="login_img">
        <img src="/template/images/ava.png">
        <form method="POST">
            <span class="login_name"><?php echo $user_data['login']; ?></span>
            <input type="submit" value="Выйти" name="Logout" class="btn_mm" />
        </form>
    </div>
    <ul class="template_list">
        <li class="menu_item"><span>1</span>Статические страницы
            <ul class="dropdown_menu">
                <li><a href="/static/">Все страницы</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>2</span>Врачи
            <ul class="dropdown_menu">
                <li><a href="/staff/all/">Все страницы</a></li>
                <li><a href="/post_staff/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>3</span>Направления
            <ul class="dropdown_menu">
                <li><a href="/direction/all/">Все страницы</a></li>
                <li><a href="/direction/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>4</span>Услуги
            <ul class="dropdown_menu">
                <li><a href="/services/all/">Все страницы</a></li>
                <li><a href="/services/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>5</span>Акции
            <ul class="dropdown_menu">
                <li><a href="/shares/all/">Все страницы</a></li>
                <li><a href="/shares/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>6</span>Блог
            <ul class="dropdown_menu">
                <li><a href="/blog/all/">Все страницы</a></li>
                <li><a href="/blog/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>6</span>Новости
            <ul class="dropdown_menu">
                <li><a href="/news/all/">Все страницы</a></li>
                <li><a href="/news/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>7</span>Отзывы
            <ul class="dropdown_menu">
                <li><a href="/reviews/all/">Все страницы</a></li>
                <li><a href="/reviews/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>8</span>Вакансии
            <ul class="dropdown_menu">
                <li><a href="/job/all/">Все страницы</a></li>
                <li><a href="/job/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>9</span>Вопрос ответ
            <ul class="dropdown_menu">
                <li><a href="/qa/all/">Все страницы</a></li>
                <li><a href="/qa/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>10</span>Программы
            <ul class="dropdown_menu">
                <li><a href="/programs/all/">Все страницы</a></li>
                <li><a href="/programs/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>11</span>Партнеры
            <ul class="dropdown_menu">
                <li><a href="/partners/all/">Все страницы</a></li>
                <li><a href="/partners/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>12</span>Настройки
            <ul class="dropdown_menu">
                <li><a href="/settings/all/">Все страницы</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>13</span>Профосмотры
            <ul class="dropdown_menu">
                <li><a href="/examination/all/">Все страницы</a></li>
                <li><a href="/examination/add/">Добавить новую</a></li>
            </ul>
        </li>
        <li class="menu_item"><span>14</span>Цены
            <ul class="dropdown_menu">
                <li><a href="/price/all/">Все страницы</a></li>
                <li><a href="/price/add/">Добавить новую</a></li>
            </ul>
        </li>
        <?php if ($user_data['role'] == "Admin") {
            echo '<li class="menu_item"><span>15</span>Пользователи
                        <ul class="dropdown_menu">
                            <li><a href="/user/all/">Все пользователи</a></li>
                            <li><a href="/user/register/">Добавить нового</a></li>
                        </ul>
                    </li>';
        }
        ?>
    </ul>
</div>