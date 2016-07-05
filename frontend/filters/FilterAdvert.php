<?

namespace frontend\filters;

use common\models\Advert;
use yii\base\ActionFilter;
use yii\web\HttpException;

class FilterAdvert extends ActionFilter{

    public function beforeAction($action){
        $id = \Yii::$app->request->get("id"); // получили id из GET запроса get("id");
        $model = Advert::findOne($id); // Обращаемся непосредственно к БД, смотрим, есть ли у нас такой id
            // $model возвращает null, если по заданному id у нас нет никаких данных
        if($model == null){
            throw new  HttpException(404,'Нет такого предложения (Проверьте id)'); // Генерируем нашу ошибку
            return false; // Если ошибка сгенерирована, возвращаем false, вызов экшена не происходит, код обрывается.
        }
        // Если все ок, вызываем род. метод beforeAction()
        return parent::beforeAction($action);

    }


    public function afterAction($action,$result){
        return parent::afterAction($action,$result);
    }


}