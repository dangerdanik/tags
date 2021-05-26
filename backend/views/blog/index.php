<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Статьи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <p align="right">
                    <?= Html::a(Yii::t('app', 'Создать статью'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
            
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="box-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'user.username',
                            'label' => 'Логин',
                        ],
                        'title',
                        [
                        'attribute' => 'building_id',
                        'value' => function ($model) {
                            if ($building = $model->building) {
                                return $building->name;
                            }
                            return '';
                        }
                        ],
                        [
                        'attribute' => 'company_id',
                        'value' => function ($model) {
                            if ($company = $model->company) {
                                return $company->name;
                            }
                            return '';
                        }
],[                            'attribute' => 'is_show',
                            'format' => 'raw',
                            'value' => function (\common\models\Article $model) {
                                   if($model->is_show === null){
                                       return;
                                   }
                                return Html::tag('span',
                                    $model::getLabelActive($model->is_show),
                                    [
                                        'class' => 'label label-big ' . $model::labelClassActive($model->is_show),
                                    ]);
                            },
                        ],
                        [
                            'attribute' => 'type',
                            'format' => 'raw',
                            'value' => function (\common\models\Article $model) {
                                if($model->type === null){
                                    return;
                                }
                                return Html::tag('span',
                                    $model->type == 2 ? 'Статья' : 'Новость',
                                    [
                                        'class' => 'text-primary',
                                    ]);
                            },
                        ],
                    // 'text:ntext',
                        // 'created_at:datetime',
                        // 'updated_at',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>