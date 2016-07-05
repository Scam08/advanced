<div class="advert-form">

    <? $form = \yii\bootstrap\ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?=\yii\helpers\Html::img(\common\components\UserComponent::getUserImage(Yii::$app->user->id), ['width' => 200]) ?>

    <?=$form->field($model,'username')->label('Имя пользователя') ?>
    <?=$form->field($model,'email')->label('E-mail') ?>
    <?=\yii\helpers\Html::label('Аватар') ?>
    <?=\yii\helpers\Html::fileInput('avatar') ?>
    <br>
    <br>


    <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <? \yii\bootstrap\ActiveForm::end() ?>


</div>