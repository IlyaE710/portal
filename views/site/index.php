<?php

/** @var yii\web\View $this */
/** @var Curriculum $curriculum */
/** @var CurriculumSearch $searchModel */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumSearch;
use app\modules\curriculum\models\Subject;
use app\modules\group\models\Group;
use app\modules\material\models\Tag;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Учебный портал ВУЗа';
Pjax::begin();
?>
<?php if(!empty($dataProvider->models)): ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="false" aria-controls="widget1">
        Открыть фильтр
    </button>
<?php endif; ?>
    <div class="collapse" id="collapse-filter">
        <?= $this->render('course-filter', [
            'model' => $searchModel,
            'data' => ArrayHelper::map(Yii::$app->user->identity->groups, 'id', 'name'), // Замените $categories на список доступных категорий
        ]) ?>
    </div>

<div id="course-list-container">
    <?= $this->render('course-list', [
        'dataProvider' => $dataProvider,
    ]) ?>
</div>

<?php Pjax::end();
