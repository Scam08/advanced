<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\db\Query;

/**
 * Default controller for the `main` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        $this->layout = "bootstrap";
        $query = new Query();// Берем  Query объект, т.е. поставитель запросов
        $query_advert = $query->from('advert')->orderBy('idadvert desc');
        $command = $query_advert->limit(5);
        /*
    from('advert') - обращаемся к таблице адверт.
    orderBy('idadvert desc') - сортируем записи по id  (desc - от большего к меньшему)
    limit(5) - указываем лимит записей.*/
        $result_general = $command->all();// Выбрали все картинки
        $count_general = $command->count();// Посчитали их количество

        $featured = $query_advert->limit(15)->all(); // Для наших предложений мы выбираем все что есть, но с установкой 15 записей
        $recommend_query  = $query_advert->where("recommend= 1")->limit(5); // В рекомендовые попад. кв. с установл. recommend=1
        $recommend = $recommend_query->all();
        $recommend_count = $recommend_query->count(); // Считаем для точек 

        return $this->render('index',[
            'result_general' => $result_general,
            'count_general' => $count_general,
            'featured' => $featured,
            'recommend' => $recommend,
            'recommend_count' => $recommend_count

        ]);
    }


    public function actionService()
    {
        $locator = \yii::$app->locator;
        $cache = $locator->cache;// Взяли локатор, получили нужный объект из локатора и теперь можем им манипулировать

        $cache->set("test",1);
        print $cache->get("test");
    }

    public function actionEvent()
    {
        $component = \Yii::$app->common; //new Common();
        // Крепим на наше событие обработчики
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin']); // 1-ый пар-р событие, 2-ой пар-р обработчик
        /*$component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin1']); // notifyAdmin1 - название нашего метода
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin2']);
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin3']);
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin4']);*/
        $component->sendMail("test@domain.com","TEST","test text");
        $component->off(Common::EVENT_NOTIFY,[$component,'notifyAdmin']); // Отключаем событие
    }
    public function actionPath()
    {
        //@yii - путь до папки с фраемворком
        //@app - путь до текущей активной папки
        //@runtime - аналогия @app
        //@webroot - указ. на директрорию в которой находится frontend/web или backend/web
        //@web - указ. url до текущей папки web
        //@vender - указ. путь до папки вендера
        //@bower -указ путь до bower'a, который н-ся в папке vender
        //@npm -указ путь до npm, который н-ся в папке vender
        //@frontend - указ на фронтент папку
        //@backend - указ на бэкэнд папку.
        // Yii::setAlias('@test','@frontend/test'); - создание своего алиаса, первая часть название, вторая путь
        // Узнаем путь до папки командой  \Yii::getAlias('@что-интересует-из-списка')
        \Yii::setAlias('@test','@frontend/test');
        print \Yii::getAlias('@test');
    }

    public function actionCacheTest() {
        // Установим кэш
        $locator = \Yii::$app->locator;
        $locator->cache->set('test',1);

        print $locator->cache->get('test');

    }

    public function actionLoginData() {
        print \Yii::$app->user->identity->email; // с помощью \Yii::$app->user->identity->email; можем получить из бд все что угодно
    }
}
