<?php
use yii\helpers\Html;
?>

<?= Yii::t('app', 'Hello, {name}', ['name' => $request->name]) ?>!<br /><br />
<?= Yii::t('app', 'We have investigated your request:') ?><br /><br />
<?= Html::a(Html::encode($request->comment)); ?><br/>

