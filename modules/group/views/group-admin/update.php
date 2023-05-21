<?php

use app\models\User;
use app\modules\group\models\Group;
use app\modules\group\models\GroupForm;
use kartik\select2\Select2;
use yii\bootstrap5\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var GroupForm $formModel */

$this->title = 'Редактирование группы: ' . $formModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $formModel->name, 'url' => ['view', 'id' => $formModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($formModel, 'name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="row">
    <?php Modal::begin([
        'title' => '<h2>Добавить студентов</h2>',
        'toggleButton' => ['label' => 'Добавить студентов', 'class' => 'btn btn-primary mb-2 col-sm-2'],
    ]); ?>

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['add-users', 'groupId' => $formModel->id]),
    ]); ?>

    <?= $form->field($formModel, 'newUsers')->widget(Select2::class, [
        'data' => ArrayHelper::map(User::find()->all(), 'id', 'email'),
        'options' => ['placeholder' => 'Выберите студентов ...'],
        'pluginOptions' => [
            'multiple' => true,
            'tags' => true, // Разрешение добавления новых элементов
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<?php Modal::end(); ?>
<?php Pjax::begin() ?>
<div class="row">
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => (Group::findOne(['id' => $formModel->id]))->getUsers(),
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'firstname',
            'patronymic',
            'lastname',
            'email',
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',
                'urlCreator' => fn ($action, User $model, $key, $index, $column) => Url::toRoute([$action . '-from-group', 'userId' => $model->id, 'groupId' => $formModel->id])
            ],
        ],
    ]); ?>
</div>
<?php Pjax::end() ?>
