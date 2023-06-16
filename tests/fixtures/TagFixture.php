<?php

namespace app\tests\fixtures;

use app\modules\material\models\Tag;
use yii\test\ActiveFixture;

class TagFixture extends ActiveFixture
{
    public $modelClass = Tag::class;
    public $dataFile = '@app/tests/fixtures/data/tags.php';
}