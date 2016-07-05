<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
        <?
        $form = \yii\bootstrap\ActiveForm::begin([
            'enableClientValidation' => false,
            'enableAjaxValidation' => true, // Включаем(true) / Выключаем (false) Ajax валидацию
        ]);
        /*         $form = \yii\bootstrap\ActiveForm::begin([
            'enableClientValidation' => false                           ------ Выключаем клиентскую валидацию
        ]);*/
        ?>

        <?
        echo $form->field($model,'username')->label('Логин'); // филд принимает 2 параметра Модель и Название атрибута, которые выводить
        ?>
        <?
        echo $form->field($model,'email'); // филд принимает 2 параметра Модель и Название атрибута, которые выводить
        ?>
        <?
        echo $form->field($model,'password')->passwordInput()->label('Пароль'); // филд принимает 2 параметра Модель и Название атрибута, которые выводить
        // Чтобы вместо открытого текста выводились **** пишем ->passwordInput()
        ?>
        <?
        echo $form->field($model,'repassword')->passwordInput()->label('Повторите пароль'); // филд принимает 2 параметра Модель и Название атрибута, которые выводить
        ?>


        <?
        // <button type="submit" class="btn btn-success" name="Submit">Register</button>
        echo \yii\helpers\Html::submitButton('Регистрация',['class' => 'btn btn-success']);// 1-ый п-р: название, 2-ой класс итп.
        ?>



        <?
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>

</div>