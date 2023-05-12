<?php

use app\modules\curriculum\models\Event;
use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['curriculum-admin/update', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Меропрития', 'url' => Url::toRoute(['event-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
            ]
        ]); ?>
    </div>
    <div class="col-md-9">
        <div class="event-index">
            <p>
                <?= Html::a('Создать Event', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'duration',
                    'typeId',
                    'curriculumId',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Event $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>


        </div>
    </div>
</div>
