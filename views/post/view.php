<?php
   /* @var $this yii\web\View */
   use yii\helpers\Html;
   $this->title = 'posts';
   $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-posts">
   <h1><?= Html::encode($this->title) ?></h1>
   <p>
      <b>title:</b> <?= $post->title ?>
   </p>
   <p>
      <b>body:</b> <?= $post->context ?>
   </p>
   <code><?= __FILE__ ?></code>
</div>
