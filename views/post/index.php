<?php
   /* @var $this yii\web\View */
   use kartik\datetime\DateTimePicker;

   use yii\helpers\Html;
   $this->title = 'posts';
   $this->params['breadcrumbs'][] = $this->title;
?>

<?php
     echo DateTimePicker::widget([
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => '23-Feb-1982 10:10',
        'pluginOptions' => [
           'autoclose'=>true,
           'format' => 'dd-M-yyyy hh:ii'
        ]
     ]);
  ?>

<div class="site-posts">
   <h1><?= Html::encode($this->title) ?></h1>
   <p>
      <b>title:</b> <?= $post[0]->title ?>
   </p>
   <p>
      <b>body:</b> <?= $post[0]->context ?>
   </p>
   <code><?= __FILE__ ?></code>
</div>
