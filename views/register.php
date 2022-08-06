 <div class="p-2">
<h1>Register</h1>
<?php $form = app\core\form\Form::begin("","post"); ?>
<?php echo $form->field($model, "firstname") ?>
<?php echo $form->field($model, "email")->customizeFieldType(\app\core\form\Field::TYPE_EMAIL) ?>
<?php echo $form->field($model, "password")->customizeFieldType(\app\core\form\Field::TYPE_PASSWORD) ?>
<?php echo $form->field($model, "passwordConfirm")->customizeFieldType(\app\core\form\Field::TYPE_PASSWORD) ?>
<button type="submit" class="btn btn-primary">Submit</button>

</div>