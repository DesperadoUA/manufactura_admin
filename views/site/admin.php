<?php
require_once(ROOT . "/views/layouts/header.php");
?>
<main class="admin_page_template">
    <?php require_once(ROOT . "/views/layouts/header_admin.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 block_sitebar">
                <?php require_once(ROOT . "/views/layouts/sitebar.php"); ?>
            </div>
            <div class="col-lg-10 block_main swiper_box">
                <!-- Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/static/all/"><img src="/template/uploads/1566466483Doc-1.jpg"></a></div>
                            <div class="details">
                                <h3>Статические страницы</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/staff/all/"><img src="/template/images/staff.jpg"></a></div>
                            <div class="details">
                                <h3>Врачи</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/direction/all/"><img src="/template/images/direction.jpg"></a></div>
                            <div class="details">
                                <h3>Направления</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/services/all/"><img src="/template/images/services.jpg"></a></div>
                            <div class="details">
                                <h3>Услуги</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/shares/all/"><img src="/template/images/shares.jpg"></a></div>
                            <div class="details">
                                <h3>Акции</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/blog/all/"><img src="/template/images/blog.jpg"></a></div>
                            <div class="details">
                                <h3>Блог</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/news/all/"><img src="/template/images/news.jpg"></a></div>
                            <div class="details">
                                <h3>Новости</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/reviews/all/"><img src="/template/images/reviews.jpg"></a></div>
                            <div class="details">
                                <h3>Отзывы</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/job/all/"><img src="/template/images/job.jpg"></a></div>
                            <div class="details">
                                <h3>Вакансии</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/qa/all/"><img src="/template/images/qa.jpg"></a></div>
                            <div class="details">
                                <h3>Вопрос ответ</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="imgBx"><a href="/programs/all/"><img src="/template/images/programs.jpg"></a></div>
                            <div class="details">
                                <h3>Программы</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <!-- Swiper JS -->
            </div>
        </div>
    </div>
</main>
<?php
require_once(ROOT . "/views/layouts/footer.php");
?>
<!-- Initialize Swiper -->