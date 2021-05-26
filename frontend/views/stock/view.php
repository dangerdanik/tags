<?php

use common\assets\IPagAsset;
use yii\widgets\Breadcrumbs;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerAssetBundle(IPagAsset::class);
?>

<nav class="breadcrumbs">
    <div class="container">
        <?= Breadcrumbs::widget([
            'tag' => false,
            'itemTemplate' => "{link}<svg><use xlink:href=\"#icon-rarrow\" /></svg>\n",
            'activeItemTemplate' => "{link}\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</nav>

<div class="container">

    <h3><?= $model->title ?><br>
        <small class="fs-60"><?= date('d.m.Y', $model->created_at) ?>
            в <?= date('H:i', $model->created_at) ?></small>
    </h3>

    <div class="news-one text-block text-block--white mb-4 clearfix">
        <?= $model->text ?>
        <img src="/thumbs/<?= $model->path ?>" style="margin-bottom: 30px; margin-top: 30px;"  class="img-fluid mb-2">
    </div>

</div>
