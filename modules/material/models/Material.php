<?php

namespace app\modules\material\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $type
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property EventPattern[] $eventPatterns
 * @property Event[] $events
 * @property File[] $files
 * @property Link[] $links
 * @property MaterialEventPattern[] $materialEventPatterns
 * @property MaterialEvent[] $materialEvents
 * @property MaterialTag[] $materialTags
 * @property Tag[] $tags
 * @property Text[] $texts
 */
class Material extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['type'], 'default', 'value' => null],
            [['type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[EventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventPatterns()
    {
        return $this->hasMany(EventPattern::class, ['id' => 'event_pattern_id'])->viaTable('material_event_pattern', ['material_id' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['id' => 'event_id'])->viaTable('material_event', ['material_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[Links]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Link::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[MaterialEventPatterns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialEventPatterns()
    {
        return $this->hasMany(MaterialEventPattern::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[MaterialEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialEvents()
    {
        return $this->hasMany(MaterialEvent::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[MaterialTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialTags()
    {
        return $this->hasMany(MaterialTag::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('material_tag', ['material_id' => 'id']);
    }

    /**
     * Gets query for [[Texts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTexts()
    {
        return $this->hasMany(Text::class, ['material_id' => 'id']);
    }
}
