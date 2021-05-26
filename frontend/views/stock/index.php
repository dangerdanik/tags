<?php

use common\assets\IPagAsset;
use yii\helpers\Html;
use frontend\widgets\tag\CloudTagWidget;


$this->title = 'Акции от застройщиков на квартиры в новостройках';

$this->registerAssetBundle(IPagAsset::class);

?>

<nav class="breadcrumbs"></nav>

<div class="container">
    <h3>Акции от застройщиков</h3>

    <div class="nav home-news__nav" role="tablist">
        <?= Html::a('Акции', '/stocks', ['class' => 'active']); ?>
        <?= Html::a('Новости', '/news'); ?>
        <?= Html::a('Статьи', '/articles'); ?>
    </div>

    <?php
    /*получаем нужные теги*/
    $cloudTags = \common\models\CloudTag::getTagName();
    ?>

    <?= CloudTagWidget::widget([
        'data' => $cloudTags
    ]); ?>
    <br>
    <div class="text-block text-block--white mb-4">
        <div class="tab-content">
            <?= $this->render('_common/list', ['models' => $models]) ?>
        </div>
    </div>
</div>
