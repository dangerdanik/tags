<?php

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $modelTag common\models\CloudTag */

$this->title =  'Обновить: ' . \yii\helpers\StringHelper::truncate($model->title, 25, '...');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Акции'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
			    <?= $this->render('_form', [
			        'model' => $model,
                    'modelTag' => $modelTag,
			    ]) ?>
			</div>
		</div>
	</div>
</div>
