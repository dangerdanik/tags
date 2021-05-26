<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $modelTag common\models\CloudTag */

$this->title = Yii::t('app', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
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
