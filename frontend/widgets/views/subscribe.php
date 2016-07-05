<?
$form = \yii\bootstrap\ActiveForm::begin([
    'enableAjaxValidation' => true,
    'validationUrl' => \yii\helpers\Url::to(['/validate/subscribe']),
    'options' => ['class' => 'form-inline'] // Чтобы форма была в 1 строчку 
]);
?>
<?=$form->field($model,'email')->textInput(['placeholder' => 'Введите ваш email'])->label(false) ?>

<?=\yii\helpers\Html::submitButton('Нажми меня!', ['class' => 'btn btn-success']) ?>

<?
\yii\bootstrap\ActiveForm::end();
?>