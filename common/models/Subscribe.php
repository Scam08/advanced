<?php

namespace common\models;

use frontend\components\Common;
use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $idsubscribe
 * @property string $email
 * @property string $date_subscribe
 */
class Subscribe extends \yii\db\ActiveRecord
{
    const EVENT_NOTIFICATION_ADMIN = 'new-notification-admin'; // Событие, кот. будет оповещать всех админов о новом пользователе
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_subscribe'], 'safe'],
            ['email', 'required','message' => 'Обязательно к заполнению'],
            ['email', 'email', 'message' => 'email адресс введен некорректно'], // е-майл проверяем на шаблон
            ['email', 'unique','message' => 'Этот email уже используется'],
        ];
    }

    public function init(){
        $this->on(self::EVENT_NOTIFICATION_ADMIN, [$this, 'notification']); // будем исл. метод notification
    }

    public function notification($event){
        $model = User::find()->where(['roles' => 'admin'])->all(); // Вызываем модель User, берем всех с ролью админ
        foreach($model as $r){
            Common::sendMail('Подписка','Новый подписчик',$r['email']); // И по каждому делаем рассылку,что появлся новый подписчик
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsubscribe' => 'Idsubscribe',
            'email' => 'Email',
            'date_subscribe' => 'Date Subscribe',
        ];
    }

    /**
     * @inheritdoc
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }
}
