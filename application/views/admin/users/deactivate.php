<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/'.$this->router->class; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo sprintf(lang('users_deactivate_question'), '<span class="label label-primary">'.$firstname.$lastname).'</span>';?></h3>
                    </div>

                    <div class="box-body">
                        <?php echo form_open('admin/users/deactivate/'. $id, array('class' => 'form-horizontal', 'id' => 'form-status_user')); ?>
                            
                        <div class="form-group">
                        <?php echo form_label('Desativar?', 'Desativar?', array('class' => 'col-sm-2 control-label')); ?>       
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="confirm" id="confirm1" value="yes" checked="checked"> <?php echo strtoupper(lang('actions_yes', 'confirm')); ?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="confirm" id="confirm0" value="no"> <?php echo strtoupper(lang('actions_no', 'confirm')); ?>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?php echo form_hidden($csrf); ?>
                                    <?php echo form_hidden(array('id'=>$id)); ?>

                                    <?php
                                        $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';                                                                            
                                        $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
                                    ?>

                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>                                       
                                    <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                    
                                </div>
                            </div>

                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>