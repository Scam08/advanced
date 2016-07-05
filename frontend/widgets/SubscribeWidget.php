<?

namespace frontend\widgets;

use frontend\components\Common;
use common\models\Subscribe;
use yii\bootstrap\Widget;

class SubscribeWidget extends  Widget{

    public function run(){
        $model = new Subscribe();

        if($model->load(\Yii::$app->request->post()) && $model->save()){ // Ввел данные, сохранили
            $model->trigger(Subscribe::EVENT_NOTIFICATION_ADMIN);

            \Yii::$app->session->setFlash('message','Успешная подписка'); // Флеш сообщений  'Успешная подписка'
            \Yii::$app->controller->redirect("/");
        }

        return $this->render("subscribe", ['model' => $model]);
    }
}