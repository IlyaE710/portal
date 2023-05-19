<?php

namespace app\modules\material\models;

use Yii;

/**
 * This is the model class for table "text".
 *
 * @property int $id
 * @property string $content
 * @property int $material_id
 *
 * @property Material $material
 */
class Text extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'material_id'], 'required'],
            [['content'], 'string'],
            [['material_id'], 'default', 'value' => null],
            [['material_id'], 'integer'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['material_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Контент',
            'material_id' => 'Material ID',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'material_id']);
    }
}
