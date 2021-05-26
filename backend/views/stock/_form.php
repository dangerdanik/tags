<?php

use common\models\Building;
use frontend\helpers\FilterHelper;
use kartik\file\FileInput;
use kartik\select2\Select2;
use vova07\imperavi\bundles\ImageManagerAsset;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\CloudTagRelation;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $modelTag common\models\CloudTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Stock-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => "multipart/form-data"]]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'start_stock')->widget(\kartik\datetime\DateTimePicker::class, [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy hh:ii'
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'end_stock')->widget(\kartik\datetime\DateTimePicker::class, [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy hh:ii'
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?php
    $valueData = [];
    if (!$model->isNewRecord) {
        $valueData = CloudTagRelation::getTagRelations($model->id);
    }
    ?>

    <label> Словарь тегов </label>
    <div class="word-tag">
        <?= Select2::widget([
            'name' => 'cloudTagId',
            /*'theme' => 'default',*/
            'data' => ArrayHelper::map($modelTag, 'id', 'name'),
            'value' => ArrayHelper::map($valueData, 'tag_id', 'tag_id'),
            'id' => 'cloudTagId',
            'options' => ['placeholder' => 'Выберите тег', 'multiple' => true, /*'disabled' => $select_disable*/],
            'maintainOrder' => true,
            'showToggleAll' => true,
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => true,
            ],
        ]);
        ?>
    </div>

    <?= $form->field($model, 'active')->dropDownList($model->activeList(), ['prompt' => '']) ?>
    <?= $form->field($model, 'view_all')->checkbox(['maxlength' => true, 'id' => 'view_all']) ?>
    <div class="cities">
        <?= $form->field($model, 'citiesNew')->widget(Select2::class, [
            'data' => ArrayHelper::map(FilterHelper::getCities(), 'id', 'title_ru'),
            'options' => [
                'placeholder' => 'Выберите регион',
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
        ?>
    </div>
    <?php
    $js = <<<JS
     if($('#view_all').prop('checked')){
          $('.cities').hide();
     }else {
        $('.cities').show();
     }
     $(document).on('change','#view_all',function(){
         if($('#view_all').prop('checked')){
          $('.cities').hide();
         }else {
            $('.cities').show();
         }
     });

JS;

    $this->registerJs($js);
    ?>

    <div class="form-group">
        <label>Картинка</label>
        <?php
        try {
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'image',
                'pluginOptions' => [
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseIcon' => '',
                    'previewFileType' => 'image',
                    'initialPreview' => $model->path ? [$model->getImageHtml('mmini', ['class' => 'file-preview-image'])] : '',
                    'initialPreviewConfig' => $model->path ? [['url' => "/blog/photo-delete", 'key' => $model->id]] : [],
                ],
                'pluginEvents' => [
                    "fileclear" => "function(event) {
                            $('[data-id='+event.currentTarget.id+']').val('');
                        }",
                ],
                'options' => [
                    'accept' => 'image/*',
                ]
            ]);
        } catch (Exception $e) {
            Yii::error($e->getMessage());
        }
        ?>
    </div>

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
        'data' => Building::getBuildingsIdName(),
        'options' => [
            'placeholder' => Yii::t('app', 'Select Building'),
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])->widget(
        Widget::class, [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'imageUpload' => Url::to(['image-upload']),
                'imageDelete' => Url::to(['file-delete']),
                'imageManagerJson' => Url::to(['images-get']),
                'plugins' => [
                    'fullscreen',
                    'clips',
                    'fontsize',
                    'fontcolor',
                ]
            ],
            'plugins' => [
                'imagemanager' => ImageManagerAsset::class,
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
