<?
use yii\bootstrap\Nav;
?>

<!-- Header Starts -->
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
            <!-- Что было
            <div class="navbar-collapse  collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.html" >Home</a></li>
                    <li><a href="about.html" >About</a></li>
                    <li><a href="agents.html" >Agents</a></li>
                    <li><a href="blog.html" >Blog</a></li>
                    <li><a href="contact.html" >Contact</a></li>
                </ul>
            </div> -->

            <div class="navbar-collapse  collapse">
                <?
                $menuItems = [      // Это наше меню. Передаем нужные нам поля в меню.
                    ['label' => 'Домой', 'url' => ['/']],
                    ['label' => 'О нас', 'url' => ['/main/main/page', 'view' => 'about']],
                    ['label' => 'Напишите нам', 'url' => ['/main/main/page', 'view' => 'contact']],
                ];
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>

            <!-- #Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->





<div class="container">

    <!-- Header Starts -->
    <div class="header">
      <!--  <a href="index.html" ><img src="images/logo.png"  alt="Realestate"></a> -->

        <?
        $menuItems = [];
        $menuItemss = [];
        $guest = Yii::$app->user->isGuest;
        if($guest) {
            $menuItems[] =  ['label' => 'Вход', 'url' => '#', 'linkOptions' => ['data-target' => '#loginpop', 'data-toggle' => "modal"]];
        }
        else{
            $menuItems[] =  ['label' => 'Предложения', 'url' => ['/cabinet/advert']];
            $menuItems[] =  ['label' => 'Настройка', 'url' => ['/cabinet/default/settings']];
            $menuItems[] =  ['label' => 'Cменить пароль', 'url' => ['/cabinet/default/change-password']];
            $menuItems[] = ['label' => 'Выйти',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
            $menuItemss[] = ['label' => 'Главная', 'url' => ['/']];
        }
        echo Nav::widget([
            'options' => ['class' => 'pull-right'],
            'items' => $menuItems,
        ]);
        echo Nav::widget([
            'options' => ['class' => 'pull-left'],
            'items' => $menuItemss,
        ]);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        ?>



    </div>
    <!-- #Header Starts -->
</div>