<?php

namespace site\controllers;

use yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;

use site\models\File;

class SiteController extends Controller{

    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get', 'post'],
                ],
            ],
        ];
    }

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        $model = new File();
        $load = $model->load(Yii::$app->request->post());
        $model->files = yii\web\UploadedFile::getInstances($model, 'files');

        // Validate, init UploadedFile and upload files
        if($load){
            if($model->validate()){
                $model->upload();
            }

            // If request is ajax then only validate model without render
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}
