<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\web\ViewAction;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([                      /* Здесь наша форма в http://localhost/advanced/frontend/web/cabinet/advert */
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idadvert',         /* Добавляя и редактирую эти значения меняем кол-во столбцов */
            'price',
            'address',
            'fk_agent', // user.email  - вывести е-майл
            'user.email',
            //'bedroom',
            //'livingroom',
            //'parking',
            //'kitchen',
            // 'general_image',
            // 'description:ntext',
            // 'location',
            // 'hot',
            // 'sold',
            // 'type',
            // 'recommend',
             'created_at:date',  // 'created_at:date' Указывает дату
             'updated_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
