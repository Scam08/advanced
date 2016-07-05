<?php

namespace app\modules\cabinet\controllers;

use common\controllers\AuthController;
use Yii;
use common\models\Advert;
use common\models\Search\AdvertSearch;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends AuthController
{
    /**
     * @inheritdoc
     */
    public $layout = "inner";


    /**
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advert model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionFileUploadGeneral(){

        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("advert_id"); // Сначала получаем advert_id
            $path = Yii::getAlias("@frontend/web/uploads/adverts/".$id."/general"); /* Внутри папки adverts/ будет создаваться запись
           по id, а в ней папка general, В нее складываем картинки $name, это лицо. А внутрь папки с $id кладем остальные картинки
        */

            BaseFileHelper::createDirectory($path); // Метод, который сначала проверяет есть ли такая папка,
            // если такой папки нету, он ее создает
            $model = Advert::findOne($id);
            $model->scenario = 'step2'; // Говорим, что мы работаем со сценарием step2

            $file = UploadedFile::getInstance($model,'general_image'); // Для загрузки картинки мы исп. UploadedFile.
            // У него есть метод getInstance, который принимает модель и наз. атриб. с кот. он работает
            $name = 'general.'.$file->extension; // Здесь мы изм. имя загружаемого файла.
            $file->saveAs($path .DIRECTORY_SEPARATOR .$name); // Сохраняем картинку , указываем путь, имя

            $image  = $path .DIRECTORY_SEPARATOR .$name;
            $new_name = $path .DIRECTORY_SEPARATOR."small_".$name; // Копия главной картинки с уст. размерами

            $model->general_image = $name; // Сохраняем имя в базе
            $model->save();

            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];
            // Приводим картинку к нужным размерам
            Image::frame($image, 0, '666', 0)
                ->crop(new Point(0, 0), new Box($width, $height)) // Обрезание картинок по ширине и высоте
                ->resize(new Box(600,600)) // Выбираем нужные размеры
                ->save($new_name, ['quality' => 100]); // Сохраняем её под другим именем см. лин 77    $new_name = $path .DIRECTORY_SEPARATOR."small_".$name;

            return true;

        }
    }


    public function actionFileUploadImages(){

        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("advert_id"); 
            $path = Yii::getAlias("@frontend/web/uploads/adverts/".$id);
            BaseFileHelper::createDirectory($path);
            $file = UploadedFile::getInstanceByName('images');
            $name = time().'.'.$file->extension;
            $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

            $image = $path .DIRECTORY_SEPARATOR .$name;
            $new_name = $path .DIRECTORY_SEPARATOR."small_".$name;

            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];

            Image::frame($image, 0, '666', 0)
                ->crop(new Point(0, 0), new Box($width, $height))
                ->resize(new Box(1000,1000)) // small_
                ->save($new_name, ['quality' => 100]);

            sleep(1); // Делаем небольшую задержку
            return true;

        }
    }

    /**
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advert();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->idadvert]);
            // Делаем переход на 2-ой шаг
            return $this->redirect(['step2']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        /*      ----------------------------------- Добавление значений в выпадающий список
            <?= $form->field($model, 'type')->dropDownList($data) ?>
        -------------------------------------------------------------------------
        $data = [];
        foreach ($model as $row) {
            $data[] = $row -> title;
        }
        */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->idadvert]);
            // Делаем переход на 2-ой шаг
            return $this->redirect(['step2']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id');
        $model = Advert::findOne($id);
        $image = [];
        if($general_image = $model->general_image){
            $image[] =  '<img src="/uploads/adverts/' . $model->idadvert . '/general/small_' . $general_image . '" width=250>';
        }

        if(Yii::$app->request->isPost){
            $this->redirect(Url::to(['advert/']));
        }

        $path = Yii::getAlias("@frontend/web/uploads/adverts/".$model->idadvert);
        $images_add = [];

        try {
            if(is_dir($path)) {
                $files = \yii\helpers\FileHelper::findFiles($path);

                foreach ($files as $file) {
                    if (strstr($file, "small_") && !strstr($file, "general")) {
                        $images_add[] = '<img src="/uploads/adverts/' . $model->idadvert . '/' . basename($file) . '" width=250>';
                    }
                }
            }
        }
        catch(\yii\base\Exception $e){}


        return $this->render("step2",['model' => $model,'image' => $image, 'images_add' => $images_add]);
    }

    /**
     * Deletes an existing Advert model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запись не найдена.');
        }
    }
}
