<?

namespace common\components;

use yii\base\Component;

class UserComponent extends Component{
    // Метод для построение ссылки до наших аватаров
    public static function getUserImage($id,$original=false){
        $base = \Yii::$app->params[''].'/uploads/users/';
       // $path = \Yii::getAlias("@frontend/web/uploads/user/");
        return $base.(($original) ? $id : 'small_'.$id).'.jpg';
    }
}