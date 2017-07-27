<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        print_r($_POST); die();
        return $this->render('index');
    }

}
