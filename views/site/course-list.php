<?php
use yii\helpers\Html;

?>
<div class="row my-4">
        <?php foreach($models as $curriculum): ?>
            <div class="col-md-4">
                <a href="<?= \yii\helpers\Url::toRoute(['curriculum/curriculum/view', 'id' => $curriculum->id]) ?>" class="card-link">
                    <div class="card card-course">
<!--                            <img src="https://via.placeholder.com/500x200" class="card-course-img-top" alt="Курс">-->
                        <img src="<?= Yii::getAlias('@web/uploads/course/'. $curriculum->image); ?>" class="card-course-img-top" alt="Курс">
                        <div class="card-body card-course-body">
                            <h5 class="card-title card-course-title"><?= $curriculum->subject->name ?> (<?= $curriculum->group->name ?>)</h5>
                            <p class="card-text card-course-text"><?= $curriculum->description ?></p>
                        </div>
                    </div>
                </a>
            </div>
<?php endforeach; ?>