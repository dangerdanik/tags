<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\CloudTagRelation;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CloudTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Словарь тегов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <p align="right">
                    <?= Html::a(Yii::t('app', 'Добавить тег'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    /*'description',*/
                    [
                        'attribute' => 'article',
                        'value' => function ($model) {
                            $data = null;
                            $valueData = CloudTagRelation::getTagsArticle($model->id);
                            if ($valueData) {
                                foreach ($valueData as $article) {
                                    if ($article['stock_title']) {
                                        $data[] = Html::a($article['stock_title'], Url::to(['/stock/update/', 'id' => $article['stock_id']]));
                                    }
                                    if ($article['article_title']) {
                                        $data[] = Html::a($article['article_title'], Url::to(['/blog/update/', 'id' => $article['article_id']]));
                                    }
                                    /*debug($article);*/
                                }
                                return implode("<br>", $data);
                            }
                        },

                        'format' => 'html'
                    ],
                    'click_count',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>


        </div>
    </div>
</div>
