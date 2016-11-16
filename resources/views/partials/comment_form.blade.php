<?php
use yii\widgets\ActiveForm;
?>
<div id="blog_comment_form">
<?php if (Yii::$app->user->isGuest): ?>
    <b>Log in to leave a comment</b>
<?php else: ?>
        <?php $form = ActiveForm::begin([
            'id' => 'comment_form'
        ]);
        ?>
        <p><b><?=Yii::t('app','Write comment here')?></b></p>
        <?= $form->field($comments, 'comment_text')->textArea(['rows'=>6,'id'=>'comment_text']) ?>

        <?= $form->field($comments, 'owner_name')->hiddenInput(['value'=> $type])->label(false)?>

        <div class="form-group">
            <button class="btn btn-raised btn-success pull-right" type="button" onclick="saveComment(this);">Отправить</button>
        </div>
        <?php ActiveForm::end(); ?>
<?php endif; ?>
</div>
