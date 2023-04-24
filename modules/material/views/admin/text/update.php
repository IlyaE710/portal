<?php

use app\modules\material\models\Text;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Text $model */

$this->title = Yii::t('app', 'Update Text: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->material_id, 'url' => ['update-material', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="text-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'materialId' => $model->material_id,
    ]) ?>

</div>
