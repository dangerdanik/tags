<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\CloudTag;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = \yii\helpers\StringHelper::truncate($model->title, 40, '...');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статьи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <p align="right">
                    <?= Html::a(Yii::t('app', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'user.username',
                        'title',
                        'text:ntext',
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
                        ],
                        [
                            'attribute' => 'tag',
                            'value' => function ($model) {
                                $data = null;
                                $valueData = CloudTag::getTagNameForArticle($model->id);
                                if ($valueData) {
                                    foreach ($valueData as $tags) {
                                        $data[] = $tags->name;
                                    }
                                    return implode(", ", $data);
                                }
                            }
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>