<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $modelTag common\models\CloudTag */

$this->title = Yii::t('app', 'Добавить акцию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
