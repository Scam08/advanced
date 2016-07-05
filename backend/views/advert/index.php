<div class="row">
    <div class="col-xs-12">
    <div class="box">


        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'idadvert',
                [
                    'label' => 'Заголовок',
                    'value' => 'title'

                ],
                [
                    'label' => 'email',
                    'value' => 'user.email'

                ],
                'price',
                'created_at:datetime',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}  {delete}',
                    'buttons'=>[
                        'view'=>function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<span class=\"glyphicon glyphicon-eye-open\"></span>", Yii::$app->params['baseUrl']."view-advert/".$key,['target' => '_blank']);
                            //  ['target' => '_blank'] - чтобы наша страница открывалась в новой вкладке
                        }
                    ],
                ],
            ],
        ]) ?>


        </div>
        </div>

    </div>