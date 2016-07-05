<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'bedroom')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'livingroom')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'parking')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'kitchen')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6,'wrap'=>'soft | hard']) ?>

    <?= $form->field($model, 'location')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'hot')->radioList(['Нет', 'Да'])->label('Считаете ли вы ваше предложений "Горячим" ') ?>

    <?= $form->field($model, 'sold')->radioList(['Нет', 'Да'])->label('Продано') ?>

    <?= $form->field($model, 'type')->dropDownList(['Обувь','Одежда', 'Снаряжение']) ?>

    <?= $form->field($model, 'recommend')->radioList(['Нет', 'Да'])->label('Добавить в рекомендуемое') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Продолжить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <br><br>

        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>