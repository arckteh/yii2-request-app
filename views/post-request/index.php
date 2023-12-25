<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Send request';
$this->params['breadcrumbs'][] = $this->title;

/** @var yii\web\View $this */
/** @var app\models\entity\Request $model */
/** @var ActiveForm $form */
?>
<div class="request-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('requestFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for posting the request us. We will respond to you as soon as possible.
        </div>

    <?php else: ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'message')->textarea() ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>

</div><!-- request-index -->
