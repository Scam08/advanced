<div class="advert-form">

    <? $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <?=$form->field($model,'password')->passwordInput()->label('Пароль') ?>
    <?=$form->field($model,'repassword')->passwordInput()->label('Повторите пароль') ?>


    <?= \yii\helpers\Html::submitButton('Сменить пароль', ['class' => 'btn btn-primary']) ?>

    <? \yii\bootstrap\ActiveForm::end() ?>


</div>