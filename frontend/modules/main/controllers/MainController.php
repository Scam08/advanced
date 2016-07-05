<?php

namespace app\modules\main\controllers;

use common\models\Advert;
use common\models\LoginForm;
use frontend\filters\FilterAdvert;
use frontend\models\ContactForm;
use frontend\models\Image;
use frontend\models\SignupForm;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\Response;
use yii\widgets\ActiveForm;


class MainController extends \yii\web\Controller
{
    public $layout = "inner";

    public function actions()
    {
        return [
            'captcha' => [/*тут вместо 'captcha' можно написать абсолютно любое имя 'petya'.Здесь мы задаем имя экшэна, по нему мы будем обращаться*/
                'class' => '\yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'test' => [
                'class' => 'frontend\actions\TestAction',
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
                'layout' => 'inner',
            ]
        ];
    }
    /* Подключаем наш FilterAdvert */
    public function behaviors(){
        return [
            [
                'only' => ['view-advert'], // Указываем, что он должен работать только для экшена view-advert, иначе будет для всех.
                'class' => FilterAdvert::className(),
            ]
        ];
    }

    public function actionFind($propert='',$price='',$apartment = ''){ // так н-ся наши кнопки

        $this->layout = 'sell';

        $query = Advert::find(); // Искать по таблице Advert
        $query->filterWhere(['like', 'address', $propert]) // используем filterWhere,т.к. если знач. приходит пустое, то в запрос строка
        //не будет добавлена. Проверка уже происходит внутри.
            ->orFilterWhere(['like', 'description', $propert]) // Ищем по адрессу или по описанию
            ->andFilterWhere(['type' => $apartment]);

        if($price){    // Здесь продумать с меньшей ценой
            /*$prices = explode("+",$price);
            if(isset($prices[0]))
            {
                $query->andWhere(['<=','price',$price[0]]);
            }*/
           /* $prices = explode ("<",$price);
            if (isset($prices[0])) {
                $query->andWhere(['<=', 'price', $prices[0]]);
            } else {*/

                $prices = explode("-",$price);

            if(isset($prices[0]) && isset($prices[1])) {
                    $query->andWhere(['between', 'price', $prices[0], $prices[1]]); //between - между, 2 по какому полю мы ищем, 3 нач. цена, 4 кон. цена
                }
            else{
                    $query->andWhere(['>=', 'price', $prices[0]]);
                }
            }


        $countQuery = clone $query; // Склонируем наш объект для постр. пагинации
        $pages = new Pagination(['totalCount' => $countQuery->count()]); // Пагинация учитывает все фильтры,
        // Пагинейшен ждет на получение конечное количество записей
        $pages->setPageSize(5); // По умолчанию пусть выводятся setPageSize(10); записей на страницу

        $model = $query->offset($pages->offset)->limit($pages->limit)->all(); // Пагидация возвр. кол-во записей на страницу
        // и offset - сдвиг.

        $request = \Yii::$app->request;
        return $this->render("find", ['model' => $model, 'pages' => $pages, 'request' => $request]);

    }

    public function actionIndex()
    {
        //$url_image = Image::getImageUrl();
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        /*
           $model->scenario = 'short_register'; - первый способ передачи сценария
            $model = new SignupForm([scenario => 'short_register']);
        */
        //$model->scenario = 'short_register';

        if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost) // Если запрос Ajax и методом POST, то мы используем объект response
        {
            if ($model->load(\Yii::$app->request->post())) {
        \Yii::$app->response->format = Response::FORMAT_JSON; // Устанавливаем, что сообщ. об ошибках долж. юыть в формате JSON
            // Все что мы передаем ниже будет возвращаться в JSON формате
            return ActiveForm::validate($model);
            }
        }

        if ($model->load(\Yii::$app->request->post()) && $model->signup() ) { /*Передаем данные методом post,
   $model->validate() подключаем серверную валидацию
   меняем на
  $model->singup()
  */
            \Yii::$app->session->setFlash('success', 'Регистрация прошла успешно'); // Добавляем ФЛЕШ сообщение - сообщение, кот. показ. 1 раз на экран и удаляется
        // 1-ое ключ, второе значение
        }
        return $this->render("register",['model' => $model]);
    }

    public function actionLogin() {
        $model = new LoginForm;

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            // Если все успешно используем метод goBack - он возвращает на ту же страницу с которой мы пришли
            $this->goBack();
        }

        return $this->render("login",['model' => $model]);
    }

    public function actionLogout()
        {
            \Yii::$app->user->logout();
            return $this->goHome();
        }

    public function actionContact()
    {

        $model = new ContactForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate() ) {
            $body = "<div>Обращение: <b> ". $model->body . " </b></div>";

            $body .= "<div>Email: <b> ". $model->email . " </b></div>";

            \Yii::$app->common->sendMail($model->subject,$body);
            print "Успешная отправка";
            die;
        }

        return $this->render("contact",['model' => $model]);

    }


    public function actionViewAdvert($id){
        
        
        $model = Advert::findOne($id);
        /* Сейчас мы не будем создавать отдельный файл в модели и прописывать в них правила валидации,
        допустим мы хотим прям сейчас, прям здесь провалидировать какие-то данные
        для этого DynamicModel($data) передаем ей в качестве массива %data=[], поля, какие хотим провалидировать
         */
        $data = ['name', 'email', 'text']; // Поля,которые хотим провалидировать
        $model_feedback = new DynamicModel($data);
        $model_feedback->addRule('name','required');// Для каждого из полей устан. правила валидации
        $model_feedback->addRule('email','required');
        $model_feedback->addRule('text','required');
        $model_feedback->addRule('email','email');


        if(\Yii::$app->request->isPost) {
            if ($model_feedback->load(\Yii::$app->request->post()) && $model_feedback->validate()){ // Если запрос post,
                // загружаем наш запрос и вызываем валидацию

                \Yii::$app->common->sendMail('Заинтересовало ваше объявление',$model_feedback->text,$model_feedback->email,$model_feedback->name); // Если валид. прошла успешно выз. sendMain
            }

        }
        // Когда бы обращаемся к конкретной квартире $model = Advert::findOne($id); нам еще необх. вызывать данные о пользователе.
        // у нас в Advert есть связка с таблицей user, его и вызываем
        $user = $model->user; // Вызвали связку
        $images = \frontend\components\Common::getImageAdvert($model,false); // Картинки для слайдера , 2-ой false- не показ. гл. картинку
        /* Если пользователь авторизован, то сразу подставляем его данные в поля email и username */
        $current_user = ['email' => '', 'username' => ''];

        if(!\Yii::$app->user->isGuest){

            $current_user['email'] = \Yii::$app->user->identity->email;
            $current_user['username'] = \Yii::$app->user->identity->username;

        }
        // Получили наши данные
        // Передали их в нашу вьюшку  'view_advert' 
        return $this->render('view_advert',[
            'model' => $model,
            'model_feedback' => $model_feedback,
            'user' => $user,
            'images' =>$images,
            'current_user' => $current_user
        ]);

    }
    public function actionAgent(){
        
        return $this->render('agent');
    }


}
