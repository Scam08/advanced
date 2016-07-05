<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
\frontend\assets\MainAsset::register($this);

?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <title><?=$this->title?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<? if (\Yii::$app->session->hasFlash('success')): ?>
        <?= \Yii::$app->session->getFlash('success');?>
<?
    endif;
?>




<?=$this->render("//common/head") // Двойной слэш "//" означает отправная точка от папки views, render() тут вьюшечный ?>


<?=$content ?> <!-- Сюда подставляются данные и sell.php -->


<?=$this->render("//common/footer") ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
