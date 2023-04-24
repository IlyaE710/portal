<?php

use app\modules\material\models\Text;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Text $model */
?>
<div class="text-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= /** @var int $materialId */
    $this->render('_form', [
        'model' => $model,
        'materialId' => $materialId,
    ]) ?>

</div>
