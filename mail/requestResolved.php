<?php
use yii\helpers\Html;
?>

<?= Yii::t('app', 'Hello') ?>!<br /><br />
<?= Yii::t('app', 'Yor request has been approved:') ?><br />
<?= Html::a(Html::encode($request->comment)); ?><br/>

