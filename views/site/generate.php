<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\GenerateFileForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Generate File';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'generate-file']); ?>
                    <?= $form->field($model, 'originalFile')->fileInput()->label('Исходный файл') ?>
                    <?= $form->field($model, 'watermark')->fileInput()->label('Водяной знак') ?>
                    <?= $form->field($model, 'width')->input('text')->label('Ширина') ?>
                    <?= $form->field($model, 'height')->input('text')->label('Высота') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сгенерировать', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
</div>
