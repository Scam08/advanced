<?
use yii\helpers\Html;
?>
<!-- Начало слайдера -->
<div id="slider" class="sl-slider-wrapper">

    <div class="sl-slider">

        <?
        foreach($result_general as $row):
        ?>
        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
            <div class="sl-slide-inner">
                <div class="bg-img" style="background-image: url('<?=\frontend\components\Common::getImageAdvert($row)[0] ?>')")"></div>


            <!-- Метод
                    отвечающий за создание картинки
                    путь до картинки указывается в явном виде
                    style="background-image: url('<?php // \frontend\components\Common::getImageAdvert($row)[0] ?>')"

                    getImageAdvert($row)[0] - Возвращает массив картинок, поэтому говорим, что нам надо взять первую картинку

                    -->



            <h2><a href="<?=\frontend\components\Common::getUrlAdvert($row) ?>"><?=\frontend\components\Common::getTitleAdvert($row) ?></a></h2>   <!-- Добавили заголовок -->
            <blockquote>
                <p class="location"><span class="glyphicon glyphicon-map-marker"></span> <?=$row['address'] ?></p>   <!-- Добавили адресс -->
                <p><?=\frontend\components\Common::substr($row['description']) ?></p>
                <cite> <?=$row['price']." rub"?></cite>
            </blockquote>
        </div>
    </div>

    <?
    endforeach;
    ?>

</div><!-- /sl-slider Конец -->



<nav id="nav-dots" class="nav-dots">
    <?
    /* Если у нас записей больше или = 1, то генерируем точку и выделяем ее,
            Если больше 1 */

    if($count_general >= 1):
        ?>
        <span class="nav-dot-current"></span>
        <?
    endif;
    ?>

    <?
    if($count_general > 1):
        foreach(range(2,$count_general) as $line):   // Если больше 1 записи , то перебираем массив и генерируем точки
            ?>
            <span></span>
            <?
        endforeach;
    endif;
    ?>
</nav>   <!-- конец точек -->

</div><!-- /slider-wrapper -->
</div>

<!-- Здесь строИЛИСЬ  наши "точки",
        <nav id="nav-dots" class="nav-dots">
            <span class="nav-dot-current"></span>
            <!-- Сколько будет <span>, столько и точек
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </nav>

    </div> /slider-wrapper
</div> -->



<div class="banner-search">
    <div class="container">
        <!-- banner -->
        <h3>Купить, продать & арендовать</h3>
        <div class="searchbar">
            <?
            if(Yii::$app->user->isGuest):
                ?>
                <div class="pull-right viewall ">
                    <p>Присоединяйтесь к нам и загружайте свои предложения.</p>
                    <button class="btn btn-info"   data-toggle="modal" data-target="#loginpop">Логин</button>        </div>
                <?
            endif;
            ?>
            <div class="row">
                <?=Html::beginForm(\yii\helpers\Url::to('main/main/find/'),'get') ?>
                <div class="col-lg-6 col-sm-6">
                    <?=Html::textInput('propert', '', ['class' => 'form-control']) ?>

                        <div class="col-lg-3 col-sm-4">
                            <?=Html::dropDownList('price', '',[
                                '0-1000' => '0 - 1000 руб.',
                                '1000-5000' => '1,000 руб. - 5,000 руб.',
                                '5000-10000' => '5,000 руб. - 10,000 руб.',
                                '10000' =>'10,000 руб. - и выше',
                            ],['class' => 'form-control', 'prompt' => 'Цена']) ?>
                        </div>


                        <div class="col-lg-3 col-sm-4">

                            <?=Html::dropDownList('apartment', '',[
                                'Обувь',
                                'Одежда',
                                'Снаряжение',
                            ],['class' => 'form-control', 'prompt' => 'Тип']) ?>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <?=Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
                            <?//<button class="btn btn-success"  onclick="window.location.href='buysalerent.html'">Поиск</button> ?>
                        </div>
                    </div>
                    <?=Html::endForm() ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="properties-listing spacer"> <a href="/main/main/find/"  class="pull-right viewall">Просмотреть весь список</a>
        <h2>Предложения</h2> <!-- Featured Properties-->
        <div id="owl-example" class="owl-carousel">

            <?
            foreach($featured as $row):
                ?>

                <div class="properties">
                    <div class="image-holder"><img src="<?=\frontend\components\Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties"/>
                        <div class="status <?=($row['sold']) ? 'sold' : 'new' ?>"><?=\frontend\components\Common::getType($row) ?></div>
                    </div>
                    <h4><a href="<?=\frontend\components\Common::getUrlAdvert($row) ?>" ><?=\frontend\components\Common::getTitleAdvert($row) ?></a></h4>

                    <i><b><p class="price">Цена: <?=$row['price'] ?> руб.</p></b></i>

                    <!-- Кружки внутри предложения ( с прицелом) -->
                    <div class="listing-detail"><!--<span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php//$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php//$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?php //$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php //$row['kitchen'] ?></span> --> </div>
                    <a class="btn btn-primary" href="<?=\frontend\components\Common::getUrlAdvert($row) ?>" >Подробнее</a>
                </div>

                <?
            endforeach;
            ?>

        </div>
    </div>
    <div class="spacer">
        <div class="row">
            <div class="col-lg-6 col-sm-9 recent-view">
                <h3>О нас </h3>
                <p>643/1 Учебная группа. <br> В настоящее время мы проходим обучении в г. Пушкин. Наша учебная группа является <u>лучшей</u> по успеваемости в военном городке №6. Мы успешно выполняем поставляемые задачи, касаемые учебных дисциплин и внутреннего порядка.<br><a href="/pages/about" >Узнать больше</a></p>

            </div>
            <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
                <h3>Рекомендуем</h3>
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        <?
                        if($recommend_count >= 1): // Если рекоменд. записей больше или = 1, то
                            ?>
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li> <!-- Делаем 1-ый кружок активным -->
                            <?
                        endif;
                        ?>

                        <?
                        if($recommend_count > 1): // Если записей больше чем 1, пробегаемся по массиву
                            foreach(range(1,$recommend_count-1) as $count):
                                ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$count ?>"></li> <!-- Строим круглишочки -->
                                <?
                            endforeach;
                        endif;
                        ?>
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <?
                        $i = 0;
                        foreach($recommend as $rec):
                            ?>
                            <div class="item <?=($i == 0) ? 'active' : '' ?>"> <!--Если это 1-ая запись, то мы ей дает актив -->
                                <div class="row">
                                    <div class="col-lg-4"><img src="<?=\frontend\components\Common::getImageAdvert($rec)[0] ?>"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="<?=\frontend\components\Common::getUrlAdvert($rec) ?>" ><?=\frontend\components\Common::getTitleAdvert($rec) ?></a></h5>
                                        <p class="price"><?=$rec['price'] ?> руб.</p>
                                        <a href="<?=\frontend\components\Common::getUrlAdvert($rec) ?>"  class="more">Детали</a> </div>
                                </div>
                            </div>
                            <?
                            $i++;
                        endforeach;
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>