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
                        <h3 class="box-title"><?php echo lang('groups_edit_group'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message;?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_group')); ?>
                            
                            <div class="form-group">
                                <?php echo lang('groups_name', 'group_name', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($group_name);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('groups_description', 'description', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($group_description); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('groups_color', 'bgcolor', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-3">
                                    <?php echo form_input($group_bgcolor); ?>                                                
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="btn-group">
                                    <?php
                                        $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                        $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                        $redo = '<i class="fa fa-refresh"></i> <span>Reiniciar</span>';
                                        $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                        $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                   
                                        ?>

                                        <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>
                                        <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>                                                  
                                        <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                                                            
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

