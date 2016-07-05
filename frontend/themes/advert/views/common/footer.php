<?
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>

<div class="footer">

    <div class="container">



        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Информация</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.html" >About</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.html" >Agents</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.html" >Blog</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.html" >Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Новостная рассылка</h4>
                <p>Получайте уведомления о последних новостях у нас на сайте.</p>

                <? echo \frontend\widgets\SubscribeWidget::widget() ?>

                <? /*
                <? echo \yii\helpers\Html::beginForm('','post',['class' => 'form-inline']) ?>
               <? // Заменили нашу форму <form class="form-inline" role="form"> ?>
                <? echo \yii\helpers\Html::textInput('email','',['class' => 'form-control', 'placeholder' => 'Введите ваш email']);?>
                <? echo \yii\helpers\Html::submitButton('Оповещать меня!',['class' => 'btn btn-success']);?>
                <?echo \yii\helpers\Html::endForm() ?> --> */ ?>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Подписывайтесь на нас</h4>

                <a href="#"><img src="/images/facebook.png"  alt="facebook"></a>
                <a href="#"><img src="/images/twitter.png"  alt="twitter"></a>
                <a href="#"><img src="/images/linkedin.png"  alt="linkedin"></a>
                <a href="#"><img src="/images/instagram.png"  alt="instagram"></a>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Связаться с нами</h4>
                <p><b>Bootstrap Realestate Inc.</b><br>
                    <span class="glyphicon glyphicon-map-marker"></span> 8290 Walk Street, Australia <br>
                    <span class="glyphicon glyphicon-envelope"></span> spaun08_@mail.ru<br>
                    <span class="glyphicon glyphicon-earphone"></span> (123) 456-7890</p>
            </div>
        </div>
        <p class="copyright">Copyright 2013. All rights reserved.	</p>


    </div></div>