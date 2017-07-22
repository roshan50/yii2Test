<?php
   namespace app\controllers;
   use yii\rest\ActiveController;
   class UserController extends ActiveController {
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      public $modelClass = 'app\models\User2';
   }
?>
