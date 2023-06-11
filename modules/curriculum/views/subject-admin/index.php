<?php

use app\modules\curriculum\models\Subject;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Предметы';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/']];
$this->params['breadcrumbs'][] = $this->title;
Pjax::begin();
?>
<div class="subject-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
<?php Pjax::end();
