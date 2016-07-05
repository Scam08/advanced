<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>
<div class="row contact">
    <div class="col-lg-6 col-sm-6">

        <?
        $form = \yii\bootstrap\ActiveForm::begin();
        ?>

        <?= $form->field($model, 'name')->label('Имя') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'subject')->label('Тема') ?>
        <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('Обращение') ?>
        <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction' => 'main/captcha',//\yii\helpers\Url::to(['main/captcha'])
        ])->label('Код проверки') ?>


        <?=\yii\helpers\Html::submitButton('Отправить',['class' => 'btn btn-success']) ?>
        <?
        \yii\bootstrap\ActiveForm::end();
        ?>


    </div>


</div>