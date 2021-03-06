<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
\frontend\assets\MainAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<? if (\Yii::$app->session->hasFlash('success')): ?>
    <? $success = \Yii::$app->session->getFlash('success');

    echo \yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => $success
    ]);
    ?>

    <?
endif;
?>


<!-- Header Starts -->
<? echo $this->render("//common/head") // Двойной слэш "//" означает отправная точка от папки views, render() тут вьюшечный ?>
<!-- #Header Starts -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"> <a href="/">Домой</a> / <?=$this->title ?> </span>
        <h2> <?=$this->title ?> </h2>

    </div>
</div>

<!-- banner -->

<!-- banner -->

<div class="container">
    <div class="spacer">
        <?=$content?>
    </div>
</div>

<? echo $this->render("//common/footer") ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
