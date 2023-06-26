<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\Homework $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Здания для домашних работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="homework-view">

    <h1><?= Html::encode($this->title) ?></h1>

<?= $model->content; ?>

</div>
