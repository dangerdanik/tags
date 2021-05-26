<?php

use common\models\Building;
use common\models\Company;
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
/* @var $model common\models\Article */
/* @var $modelTag common\models\CloudTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <? /*=debug($modelTag);*/ ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => "multipart/form-data"]]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'is_show')->dropDownList($model->activeList(), ['prompt' => 'Выберите активность']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->dropDownList($model->typeList(), ['prompt' => 'Выберите тип']) ?>
        </div>

        <?php
        $valueData = [];
        if (!$model->isNewRecord) {
            $valueData = CloudTagRelation::getTagRelations($model->id);
        }
        ?>

        <div class="col-md-6 col-md-offset-6">
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
        </div>
    </div>
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

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
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

    <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
        'data' => Company::getCompanysIdName(),
        'options' => [
            'placeholder' => Yii::t('app', 'Select Company'),
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

<?php
$js = <<<JS
$(document).ready(function(){
    if(parseInt($('#article-type').val()) === 2){
     $('.field-article-building_id').hide();
      $('.field-article-description').show();
  }else {
       $('.field-article-building_id').show();
        $('.field-article-description').hide();
  }
});
$(document).on('change', '#article-type',function() {
  if( parseInt(this.value) === 2){
      $('.field-article-building_id').hide();
      $('.field-article-description').show();
  }else {
       $('.field-article-building_id').show();
        $('.field-article-description').hide();
  }
});
JS;

$this->registerJs($js);

?>
