<? //   ------------------------------- ГЛАВНЫЙ ПОИСК ----------------------------------
use yii\helpers\Html;
?>

<div class="properties-listing spacer">

    <div class="row">
        <div class="col-lg-3 col-sm-4 ">
            <?=\yii\helpers\Html::beginForm(\yii\helpers\Url::to('/main/main/find/'),'get') ?>
            <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Поиск </h4>
                <?=Html::textInput('propert', $request->get('propert'), ['class' => 'form-control', 'placeholder' => 'Поиск по описаниям']) ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?=Html::dropDownList('price', $request->get('price'),[
                            '0-1000' => '0 - 1000 руб.',
                            '1000-5000' => '1,000 руб. - 5,000 руб.',
                            '5000-10000' => '5,000 руб. - 10,000 руб.',
                            '10000' =>'10,000 руб. - и выше',
                        ],['class' => 'form-control', 'prompt' => 'Цена']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Тип в таблице advert столбец type 0,1,2 соответственно -->
                        <?=Html::dropDownList('apartment', $request->get('apartment'),[
                            'Обувь',
                            'Одежда',
                            'Снаряжение',
                        ],['class' => 'form-control', 'prompt' => 'Тип']) ?>
                    </div>
                </div>
                <button class="btn btn-primary">Найти</button>
                <?=\yii\helpers\Html::endForm() ?>

            </div>



            <div class="hot-properties hidden-xs">

                <? echo \frontend\widgets\HotWidget::widget() ?>

            </div>


        </div>

        <div class="col-lg-9 col-sm-8">
            <div class="row">

                <?
                foreach($model as $row):
                    $url = \frontend\components\Common::getUrlAdvert($row);
                    ?>
                    <!-- properties -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="properties">
                            <div class="image-holder"><img src="<?=\frontend\components\Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties">
                                <div class="status <?=($row['sold']) ? 'sold' : 'new' ?>"><?=\frontend\components\Common::getType($row) ?></div>
                            </div>
                            <h4><a href="<?=$url ?>" ><?=\frontend\components\Common::getTitleAdvert($row) ?></a></h4>
                            <p class="price">Price: $<?=$row['price'] ?></p>
                            <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$row['kitchen'] ?></span> </div>
                            <a class="btn btn-primary" href="<?=$url ?>" >Подробнее</a>
                        </div>
                    </div>

                    <?
                endforeach;
                ?>
                <!-- properties -->


                <div class="clearfix"></div>
                <!-- properties -->
                <div class="center">
                    <? echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </div>

            </div>
        </div>
    </div>
</div>