<?php

use yii\widgets\ActiveForm;
use site\components\Html;
/**
 * @var yii\web\View $this
 * @var site\models\File $model
 */
?>

<div class="panel panel-default form-panel">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                Example file upload
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id' => 'form',
                'options' => ['enctype' => 'multipart/form-data', 'role' => 'form'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ]); ?>
                <div class="form-group">
                    <?=$form->field($model, 'file_prefix')->textInput()?>
                </div>
                <div class="form-group">
                    <?=$form->field($model, 'files[]')->fileInput(['multiple' => true])?>
                </div>
                <?=Html::submitButton('Save', ['class' => 'btn btn-primary btn-send_form'])?>
                <?=Html::loader(20, 'file-loader')?>
                <div class="clearfix"></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="panel panel-default form-panel">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                List of uploaded files
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body file-list">
        </div>
    </div>
</div>