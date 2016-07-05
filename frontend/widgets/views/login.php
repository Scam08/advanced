<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-6 login">
                    <h4>Логин</h4>


                    <?
                    $form = \yii\bootstrap\ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'validationUrl' => \yii\helpers\Url::to(['/validate/index']),
                    ]);
                    ?>

                    <?=$form->field($model,'username')->label('Логин') ?>
                    <?=$form->field($model,'password')->passwordInput()->label('Пароль') ?>
                    <?=$form->field($model,'rememberMe')->checkbox()->label("<br>"."<h6>" .'Запомнить меня'. "</h6>") ?>

                    <?=\yii\helpers\Html::submitButton('Войти',['class' => 'btn btn-success']) ?>


                    <?
                    \yii\bootstrap\ActiveForm::end();
                    ?>

                </div>
                <div class="col-sm-6">
                    <h4>Присоединяйтесь</h4>
                    <p><b>Присоединяйтесь к нам и загружайте свои предложения.</p>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='<?=\yii\helpers\Url::to('main/main/register/') ?>'">Зарегистрироваться</button>
                </div>

            </div>
        </div>
    </div>
</div>