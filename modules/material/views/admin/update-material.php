<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use yii\bootstrap5\Modal;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Material $model */

$this->title = 'Создание материала';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Ссылки</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Добавить1', 'class' => ['link-primary']],
                                    'id' => 'addLinkModal',
                                ]);?>

                                <?= $this->renderAjax('link/add', ['model' => new Link(), 'materialId' => $model->id]) ?>

                                <?php Modal::end(); ?>
                            </li>
                            <li>
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Список', 'class' => ['link-primary']],
                                    'id' => 'indexLinkModal',
                                ]);?>

                                <?= $this->renderAjax('link/index', ['dataProvider' => new ActiveDataProvider([
                                    'query' => Link::find()])]) ?>

                                <?php Modal::end(); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Тексты</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Добавить', 'class' => ['link-primary']],
                                    'id' => 'addTextModal',
                                ]);?>

                                <?= $this->renderAjax('text/add', ['model' => new Text(), 'materialId' => $model->id]) ?>

                                <?php Modal::end(); ?>
                            </li>
                            <li>
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Список', 'class' => ['link-primary']],
                                    'id' => 'indexTextModal',
                                ]);?>

                                <?= $this->renderAjax('text/index', ['dataProvider' => new ActiveDataProvider([
                                    'query' => Text::find()])]) ?>

                                <?php Modal::end(); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Файлы</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Добавить', 'class' => ['link-primary']],
                                    'id' => 'addFileModal',
                                ]);?>

                                <?= $this->renderAjax('file/add', ['model' => new File(), 'materialId' => $model->id]) ?>

                                <?php Modal::end(); ?>
                            </li>
                            <li>
                                <?php Modal::begin([
                                    'toggleButton' => ['label' => 'Список', 'class' => ['link-primary']],
                                    'id' => 'indexFileModal',
                                ]);?>

                                <?= $this->renderAjax('file/index', ['dataProvider' => new ActiveDataProvider([
                                    'query' => File::find()])]) ?>

                                <?php Modal::end(); ?>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col py-3">
            <div class="material-create">

                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form-material', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->renderAjax('link/add', ['model' => new Link(), 'materialId' => $model->id]) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="indexLinkModal" tabindex="-1" aria-labelledby="indexLinkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="indexLinkModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->renderAjax('link/index', ['dataProvider' => new ActiveDataProvider([
            'query' => \app\modules\material\models\Link::find()])]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<!--    <div class="modal fade" id="indexTextModal" tabindex="-1" aria-labelledby="indexTextModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="indexTextModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php /*= $this->renderAjax('text/index', ['dataProvider' => new ActiveDataProvider([
                        'query' => \app\modules\material\models\Text::find()])]) */?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Modal -->
</div>