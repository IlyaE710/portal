<?php

use app\modules\material\models\Link;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Link $model */
?>
<div class="link-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= /** @var string $material_id */
    $this->render('_form', [
        'model' => $model,
        'materialId' => $materialId,
    ]) ?>

</div>
