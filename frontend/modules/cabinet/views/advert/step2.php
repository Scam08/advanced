<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <div class="row">
        <?
        echo $form->field($model, 'general_image')->widget(\kartik\file\FileInput::classname(),[
            'options' => [
                'accept' => 'image/*',  // В опциях указываем тип данных, которые мы будем прогружать, * означает любой тип картинок
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),  // Url на который будут загружаться наши картинки
                'uploadExtraData' => [
                    'advert_id' => $model->idadvert, // Дополнительные поля, которые мы будем отправлять вместе с запросом
                ],
                'allowedFileExtensions' =>  ['jpg', 'png','gif'], // Какие расширения я разрешаю
                'initialPreview' => $image,
                'showUpload' => true, // Кнопка загрузки
                'showRemove' => true, // Кнопка удаления
                'dropZoneEnabled' => false // Дроп зона (перемещение картинок)
            ]
        ]);
        ?>

    </div>

    <div class="row">
        <?
        echo \yii\helpers\Html::label('Изображение');

        echo \kartik\file\FileInput::widget([
            'name' => 'images',
            'options' => [
                'accept' => 'image/*', // В опциях указываем тип данных, которые мы будем прогружать, * означает любой тип картинок
                'multiple'=>true
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-images']), // Url на который будут загружаться наши картинки
                'uploadExtraData' => [
                    'advert_id' => $model->idadvert, // Дополнительные поля, которые мы будем отправлять вместе с запросом
                ],
                'overwriteInitial' => true, // Перезапись картинки
                'allowedFileExtensions' =>  ['jpg', 'png','gif'], // Какие расширения я разрешаю
                'initialPreview' => $images_add,
                'showUpload' => true, // Кнопка загрузки
                'showRemove' => true, // Кнопка удаления
                'dropZoneEnabled' => false // Дроп зона (перемещение картинок)
            ]
        ]);
        ?>

    </div>
    <br>
    <br>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Create' : "\n".'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php \yii\bootstrap\ActiveForm::end(); ?>