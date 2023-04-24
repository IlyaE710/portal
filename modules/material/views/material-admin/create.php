<?php

use app\modules\material\models\Material;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Material $model */

$this->title = 'Создание материала';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
