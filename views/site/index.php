<?php

/** @var yii\web\View $this */
/** @var Curriculum $curriculum */

use app\modules\curriculum\models\Curriculum;
use yii\helpers\Html;

$this->title = 'My Yii Application';
$user = Yii::$app->user->identity;
$groups = $user->groups;
?>

<div class="row">
        <?php foreach($groups as $group): ?>
            <?php foreach($group->curriculums as $curriculum): ?>
                <div class="col-md-4">
                    <a href="<?= \yii\helpers\Url::toRoute(['curriculum/curriculum/view', 'id' => $curriculum->id]) ?>" class="card-link">
                        <div class="card card-course">
                            <img src="https://via.placeholder.com/500x200" class="card-course-img-top" alt="Курс">
                            <div class="card-body card-course-body">
                                <h5 class="card-title card-course-title"><?= $curriculum->subject->name ?></h5>
                                <p class="card-text card-course-text"><?= $curriculum->description ?></p>
                            </div>
                        </div>
                    </a>
                </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

