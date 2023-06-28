<?php

use app\modules\homework\models\HomeworkFile;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswer $model */

$this->title = 'Ответ на Д/З: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ответы студентов', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="homework-answer-update">

    <h2><?= Html::encode('Ответ студента') ?></h2>
    <p><?= $model->content ?></p>


    <?php if($model->getHomeworkFiles()->count() !== 0): ?>
        <?= GridView::widget([
            'id' => 'link-grid-view',
            'dataProvider' => new ActiveDataProvider([
                'query' => $model->getHomeworkFiles(),
            ]),
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped'],
            'columns' => [
                [
                    'class' => SerialColumn::class
                ],
                'pathname',
                [
                    'format' => 'raw',
                    'value' => function (HomeworkFile $model) {
                        return Html::a(
                            'Посмотреть',
                            Yii::getAlias('@web/uploads/homeworks/'. $model->pathname), ['target' => '_blank', 'data-pjax' => '0']
                        );
                    }
                ],
            ],
        ]); ?>
    <?php endif; ?>

    <h2><?= Html::encode('Вопрос') ?></h2>
    <?= $model->homework->content ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
