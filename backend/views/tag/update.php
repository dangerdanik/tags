<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CloudTag */

$this->title = 'Обновить тег: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Словарь тегов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>