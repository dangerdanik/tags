<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $click_count
 * @property string|null $description
 */
class CloudTag extends \yii\db\ActiveRecord
{
    public $article;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['click_count'], 'integer'],
            [['name'], 'required'],
            [['name', 'description',], 'string', 'max' => 255],
            [['article',], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'click_count' => 'Click Count',
            'description' => 'Описание',
            'article' => 'Статьи'
        ];
    }

    public static function getTagName()
    {
        return self::find()->select(['tags.id', 'tags.name', 'tags.description', 'COUNT(tags_relations.tag_id) as count'])
            ->leftJoin('tags_relations', 'tags_relations.tag_id = tags.id')
            ->groupBy('tags.id, tags.name')
            ->orderBy(['count' => SORT_DESC])
            ->asArray()
            ->all();
    }

    public static function getTagNameForStock($stockId)
    {
        return self::find()->select(['tags.id', 'tags.name', 'COUNT(tags_relations.tag_id) as count'])
            ->leftJoin('tags_relations', 'tags_relations.tag_id = tags.id')
            ->where(['tags_relations.stock_id' => $stockId])
            ->groupBy('tags.id, tags.name')
            ->all();
    }

    public static function getTagNameForArticle($articleId)
    {
        return self::find()->select(['tags.id', 'tags.name', 'COUNT(tags_relations.tag_id) as count'])
            ->leftJoin('tags_relations', 'tags_relations.tag_id = tags.id')
            ->where(['tags_relations.articles_id' => $articleId])
            ->groupBy('tags.id, tags.name')
            ->all();
    }

    public static function incCounter($tagId){

    }
}
