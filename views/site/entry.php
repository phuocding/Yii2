<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Entry';
$this->params ['breadcrumbs'] [] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->field($model, 'name')->label('Your Name') ?>

	<?php echo $form->field($model, 'email')->label('Your Email') ?>

<div class="form-group">
		<?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end() ?>