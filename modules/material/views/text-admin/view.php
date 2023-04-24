<?php

use app\modules\material\models\Text;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var Text $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = ['label' => 'Тексты', 'url' => ['text-admin/index', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="text-view">

    <h1><?= Html::encode('Просмотр текста') ?></h1>

    <?= $model->content; ?>

</div>