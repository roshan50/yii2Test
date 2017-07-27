<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;

$this->title = 'dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>you are log in now with:</p>

    <?php
    echo 1;
    print_r($userIdentity);
    $user = Yii::$app->getSession();
    print_r($user);
    echo 2;
    ?>

</div>
