<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use app\widgets\sidebar\SidebarWidget;
use yii\bootstrap5\Modal;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var Link $model */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = ['label' => 'Ссылки', 'url' => ['index', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
