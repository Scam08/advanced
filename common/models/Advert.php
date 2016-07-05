<?php

namespace common\models;

use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "advert".
 *
 * @property integer $idadvert
 * @property integer $price
 * @property string $address
 * @property integer $fk_agent
 * @property integer $bedroom
 * @property integer $livingroom
 * @property integer $parking
 * @property integer $kitchen
 * @property string $general_image
 * @property string $description
 * @property string $location
 * @property integer $hot
 * @property integer $sold
 * @property string $type
 * @property integer $recommend
 * @property integer $created_at
 * @property integer $updated_at
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_image'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'required','message' => 'Введите цену'],
            [['price', 'fk_agent', 'bedroom', 'livingroom', 'parking', 'kitchen', 'hot', 'sold', 'type', 'recommend'], 'integer','message' => 'Значение должны быть целочисленными'],
            [['description'], 'string'],
            [['address'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 50],
            //['general_image', 'file', 'extensions' => ['jpg','png','gif']]
        ];
    }

    public function getTitle(){

        return Common::getTitleAdvert($this); // Возвращаем метод getTitleAdvert из frontend/components/common
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idadvert' => 'id Объявления',
            'price' => 'Цена',
            'address' => 'Адрес',
            'fk_agent' => 'Агент продаж',
            'bedroom' => 'Bedroom',
            'livingroom' => 'Livingroom',
            'parking' => 'Parking',
            'kitchen' => 'Kitchen',
            'general_image' => 'Главное изображение',
            'description' => 'Описание',
            'location' => 'Location',
            'hot' => 'Hot',
            'sold' => 'Sold',
            'type' => 'Type',
            'user.email' => 'email пользователя',
            'recommend' => 'Recommend',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id' => 'fk_agent']); // Здесь мы связываем таблицу Advert с таблицей User
        // Связка с помощью hasOne() ;  в ней говорим с какой таблицей мы связываем User::className(), говорим, что в
        // таблице User у нас это поля id, а в таблице Advert поле fk_agent
    }

    /* В ActiveRecord есть множество готовых событий, такие как
    beforeValidate - событие срабатывает до того, как была сделана валидация
    afterValidate - событие срабатывает после того, как была сделана валидация
    beforeSave - событие срабатывает перед сохранением в базу
    afterSave - событие срабатывает после сохранения в базу
    beforeFind - событие срабатывает перед использованием выборки( find )
    afterFind - событие срабатывает после использования выборки( find )

    */

    public function afterValidate(){
        $this->fk_agent = Yii::$app->user->identity->id;
    }

    public function afterSave(){
        Yii::$app->locator->cache->set('id',$this->idadvert);
    }

    /**
     * @inheritdoc
     * @return AdvertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdvertQuery(get_called_class());
    }
}
