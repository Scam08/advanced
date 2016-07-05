<?php
namespace frontend\components;

use common\models\User;
use yii\helpers\BaseFileHelper;
use yii\base\Component;
use yii\helpers\Url;

class Common extends Component{
    // Здесь создадим событие -----------------
    const EVENT_NOTIFY = 'notify_admin';
    /*
    Допустим отправляем письмо,когда мы отправляем письмо будет происходить
     событие,которое  оповещает администрацию об этом письме.
    */
    // Конец события ---------

    public function sendMail($subject,$text,$emailFrom='spaun08_@mail.ru',$nameFrom='Advert') {
       if ( \Yii::$app->mail->compose()
            ->setFrom(['vka643@yandex.ru' => 'Advert'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()) {
            $this->trigger(self::EVENT_NOTIFY);
           return true;
       }

        //Активизируем наше событие через триггер
        $this->trigger(self::EVENT_NOTIFY); // В триггер передаем сам элемент нашего события
    }

    public function notifyAdmin($event) {

        print "Notify Admin";
    }

    public static function getTitleAdvert($data){  // Метод генерирует title
        
        if($data['sold'] == 1) {
            return 'Продано';
        }  else {
            return 'Имеется в наличии';
        }
       //return $data['bedroom'].' Спальных комнат и '.$data['kitchen'].' Кухань on Sale'; // кол-во комнат,кухань итд.
        //Генерируем подобие заголовка
    }

    public static function getImageAdvert($data,$general = true,$original = false){ // Метод отвечает за создание картинки
        // $general= true - нужна ли нам гл. картинка
        // $original - нужна ли оригинальная картинка или нет
/*
        $image = [];
        $base = Url::base(); // Указываем базовый путь до картинки
        if($original){

            $image[] = $base.'/uploads/adverts/'.$data['idadvert'].'/general/'.$data['general_image']; // Строим путь до картинки
        }
        else{
            $image[] = $base.'/uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
        }

        return $image;
   */

        $image = [];
        $base = Url::base(); /* 2 способа, либо оставить это путым и сделатьь uploads/adverts/
                                           либо сделать $base = Url::base();  и /uploads/adverts/
                            */
        if($general){

            $image[] = $base.'/uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
        }
        else{
            $path = \Yii::getAlias("@frontend/web/uploads/adverts/".$data['idadvert']);
            $files = BaseFileHelper::findFiles($path); // Получаем все файлы из директории adverts

            foreach($files as $file){
                if (strstr($file, "small_") && !strstr($file, "general")) { //Нам нужны уменьш. копии наших доп. картинок,
                                                                            // Но не нужна папка general
                    $image[] = $base . '/uploads/adverts/' . $data['idadvert'] . '/' . basename($file); // Построили путь
                    // И возвращаем массив с нашими картинками обратно
                }
            }
        }

        return $image;
    }




    public static function substr($text,$start=0,$end=50){ // по умолч. обрезаем до 50 символов

        return mb_substr($text,$start,$end); // Мультибайтовый substr
    }

    public static function getType($row){
        return ($row['sold']) ? 'Продан' : 'Новые'; // Sold редактировать тут
    }

    public function getUrlAdvert($row){
            // Передаем
        return Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]);
    }


}