<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">

        <? $form = \yii\bootstrap\ActiveForm::begin();?>

        <?
        echo $form->field($model,'username')->label('Логин'); // филд принимает 2 параметра Модель и Название атрибута, которые выводить
        ?>

        <?
        echo $form->field($model,'password')->passwordInput()->label('Пароль');
        ?>

        <?
        echo $form->field($model,'rememberMe')->checkbox()->label('Запомнить меня');
        ?>
        <?= \yii\helpers\Html::submitButton('login',['class' => 'btn btn-success']) ?>

        <?
        \yii\bootstrap\ActiveForm::end();
        ?>

    </div>
</div>