<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title"><?php echo  $texto_create; ?></h>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>
                        <?php echo form_hidden($id); ?>
                        
                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>

                        <div class="form-group">
                            <?php echo form_label('Descrição', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-lg-8">
                                <?php echo form_textarea($descricao); ?>
                            </div>
                        </div>

                        
                        <?php echo form_fieldset_close(); ?>

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
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>