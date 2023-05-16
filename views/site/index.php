<?php

/** @var yii\web\View $this */
/** @var Curriculum $curriculum */

use app\modules\curriculum\models\Curriculum;
use yii\helpers\Html;

$this->title = 'My Yii Application';
$user = Yii::$app->user->identity;
$groups = $user->groups;
?>

<a href="#"></a>
<div class="container">
    <div class="row">
        <?php foreach($groups as $group): ?>
            <?php foreach($group->curriculums as $curriculum): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="https://picsum.photos/300/200?random=<?= rand(1,200); ?>" class="card-img-top card-img" alt="Product image">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text"><?= $curriculum->description ?></p>
                            <!--                <p class="card-text"><small class="text-muted">Price: $19.99</small></p>-->
                            <?= Html::a('Перейти', ['curriculum/curriculum/view', 'id' => $curriculum->id], ['class' => '"btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>
