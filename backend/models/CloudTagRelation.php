<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags_relations".
 *
 * @property int $id
 * @property int|null $stock_id
 * @property int|null $tag_id
 * @property int|null $news_id
 * @property int|null $articles_id
 */
class CloudTagRelation extends \yii\db\ActiveRecord
{
    const BLOG = 'blog';
    const STOCK = 'stock';
    const TYPE_NEWS = 1;
    const TYPE_ARTICLE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags_relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_id', 'tag_id', 'news_id', 'articles_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stock_id' => 'Stock ID',
            'tag_id' => 'Tag ID',
            'news_id' => 'News ID',
            'articles_id' => 'Articles ID',
        ];
    }

    public static function getTagRelations($id)
    {
        $controller = Yii::$app->controller->id;
        $data = null;
        switch ($controller) {
            case self::STOCK:
                $data = CloudTagRelation::find()->select('tag_id')->where(['stock_id' => $id])->asArray()->all();
                break;
            case self::BLOG:
                    $data = CloudTagRelation::find()->select('tag_id')->where(['articles_id' => $id])->asArray()->all();
                break;
        }
        return $data;
    }

    public function saveTagRelations($arr, $id)
    {
        $controller = Yii::$app->controller->id;
        $this->deleteTagsRelations($id, $controller);
        if ($arr) {
            switch ($controller) {
                case self::STOCK:
                    $this->saveStock($arr, $id);
                    break;
                case self::BLOG:
                        $this->saveArticle($arr, $id);
                    break;
            }
        }
    }

    public function saveStock($arr, $id)
    {
        foreach ($arr as $tagId) {
            $model = new CloudTagRelation();
            $model->stock_id = $id;
            $model->tag_id = $tagId;
            $model->save();
        }
    }

    /*public function saveNews($arr, $id)
    {
        foreach ($arr as $tagId) {
            $model = new CloudTagRelation();
            $model->news_id = $id;
            $model->tag_id = $tagId;
            $model->save();
        }
    }*/

    public function saveArticle($arr, $id)
    {
        foreach ($arr as $tagId) {
            $model = new CloudTagRelation();
            $model->articles_id = $id;
            $model->tag_id = $tagId;
            $model->save();
        }
    }

    public function deleteTagsRelations($id, $controller)
    {
        switch ($controller) {
            case self::STOCK:
                $this->deleteAll(['stock_id' => $id]);
                break;
            case self::BLOG:
                /*$this->deleteAll(['news_id' => $id]);*/
                $this->deleteAll(['articles_id' => $id]);
                break;
        }
    }

    public function getTagsForFront($tag_id)
    {
        if(is_numeric($tag_id)){
            return self::find()->select([
                'stock.id as stock_id',
                'article.id as article_id',
                'article.title as article_title',
                'stock.title as stock_title',
                'stock.path as stock_path',
                'article.path as article_path',
                'article.type as article_type'
            ])
                ->leftJoin('stock', 'stock.id = stock_id')
                ->leftJoin('article', 'article.id = articles_id')
                ->where(['tag_id' => $tag_id])
                ->asArray()
                ->all();
        }
    }

    public static function getTagsArticle($tag_id)
    {
        if(is_numeric($tag_id)){
            return self::find()->select([
                'tag_id as tag_id',
                'stock.id as stock_id',
                'article.id as article_id',
                'article.title as article_title',
                'stock.title as stock_title',
            ])
                ->leftJoin('stock', 'stock.id = stock_id')
                ->leftJoin('article', 'article.id = articles_id')
                ->where(['tag_id' => $tag_id])
                ->asArray()
                ->all();
        }
    }
}
