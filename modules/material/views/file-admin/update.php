<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use yii\bootstrap5\Modal;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Link $model */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = ['label' => 'Ссылки', 'url' => ['index', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-update">

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Меню</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <?= Html::a('Оснавная информация', Url::toRoute(['material-admin/update', 'id' => $model->material_id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?php Url::remember() ?>
                            <?= Html::a('Ссылки', Url::toRoute(['link-admin/index', 'id' => $model->material_id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?= Html::a('Файлы', Url::toRoute(['link-admin/index', 'id' => $model->material_id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?= Html::a('Тексты', Url::toRoute(['link-admin/index', 'id' => $model->material_id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3">
                <div class="material-update">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>

</div>
