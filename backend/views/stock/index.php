<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <p align="right">
                    <?= Html::a(Yii::t('app', 'Добавить акцию'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
            
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="box-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                     'filterModel' => $searchModel,
                    'columns' => [
                        'title',
                        [
                        'attribute' => 'building_name',
                        'label' => 'Новостройка',
                        'value' => function ($model) {
                            if ($building = $model->building) {
                                return $building->name;
                            }
                            return '';
                        }
                        ],
                    // 'text:ntext',
                         [
                             'attribute' =>'start_stock',
                             'value' => function($model){
                            return  $model->start_stock;
                             }],
                        [
                            'attribute' =>'end_stock',
                            'value' => function($model){
                                return  $model->end_stock;
                            }],
                        [
                            'attribute' => 'active',
                            'format' => 'raw',
                            'value' => function($data) {
                                return $data->active == 1 ? '<span class="text-green">Активен</span>'
                                    : '<span class="text-black">Неактивен</span>';

                            },
                            'contentOptions'=>['style'=>'width: 80px;'],
                            'filter' => Html::activeDropDownList($searchModel, 'active',$searchModel->listActive(),['prompt' => '']),
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>