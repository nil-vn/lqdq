<style>
    #abc{margin-left: 35px;}
</style>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'abc',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'onsubmit' => 'return false;',
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo CHtml::errorSummary($model); ?>
    <?php
        $encryptedmessage = encrypt($model->pass);
        $decr = decrypt($encryptedmessage);
    ?>
    <div class="row">
        <input type="hidden" id="getid"  value=<?php echo $model->id ?> >
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 80, 'maxlength' => 128, 'style' => 'height:20px;')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'pass'); ?>
        <?php echo $form->textField($model, 'pass', array('size' => 80, 'maxlength' => 128, 'style' => 'height:20px;','value'=> $decr)); ?>
        <!--input type="text" id="Text" name="Text" value="<?php //echo $decr; ?>"/-->
        <?php //echo CHtml::activeTextField($model,'pass',array('value'=> $decr)) ?>
        <?php echo $form->error($model, 'pass'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'host'); ?>
        <?php echo $form->textField($model, 'host', array('size' => 80, 'maxlength' => 128, 'style' => 'height:20px;')); ?>
        <?php echo $form->error($model, 'host'); ?>
    </div>
    <div class="row buttons">
        <?php ?>
        <?php
        if (isset($model->id))
        {
            ?>
            <input type="submit" value="Save" id="save" class="btn btn-default">
            <?php
        } else
        {
            ?>
            <?php ?>
            <input type="submit" value="Create" id="create" class="btn btn-default">
        <?php } ?>
        <?php $this->endWidget(); ?>

    </div><!-- form -->

    <script>

        $(function() {

            $("#abc").submit(function() {
                if ($('#create').val() == 'Create')
                {
                    $("#create").click(function() {
                        $.ajax({
                            type: "POST",
                            url: '/back-office/configCronEmail/create',
                            data: $('#abc').serialize(),
                            success: function(data)
                            {
                                var obj = $.parseJSON(data);
                                $('.fu_insert').after('<tr><td>' + obj.email + '</td><td>' + obj.pass + '</td><td>' + obj.host + '</td><td>' + obj.created + '</td><td><a id=' + obj.id + ' rel="gallery" class="updateEmail"  href="javascript:void(0);"><img style="width: 11px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/list-icons/edit.gif"/></a> <a id=' + obj.id + ' class="deleteEmail"  href="javascript:void(0);"><img style="width: 15px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webmail/iconDeleteFolder.gif"/></a></td></tr>');
//                                  $.fancybox.close(); 
                            }
                        });
                    });
                    return false;
                }

                if ($('#save').val() == 'Save')
                {
                    $("#save").click(function() {
                        var id = $('#getid').val();
                        $.ajax({
                            type: "POST",
                            url: '/back-office/configCronEmail/update/' + id,
                            data: $('#abc').serialize(),
                            success: function(data)
                            {
//                                var obj = $.parseJSON(data);
//                                $('.table').append('<tr><td>' + obj.email + '</td><td>' + obj.pass + '</td><td>' + obj.host + '</td></tr>');

//                                if (data) {
//                                    $.fancybox.close();
//
//
//                                }
                            }
                        });

                    });
                    return false;
                }
            });
        });
    </script>
    <?php
    ?>