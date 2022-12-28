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
                        <h3 class="box-title"><?php echo  $texto_create; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form_create')); ?>

                        <?php echo form_fieldset('Dados'); ?>

                        <div class="form-group">
                            <?php echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($nome); ?>
                            </div>
                       
                            <?php echo form_label('Telefone', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($telefone); ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <?php echo form_label('Profissao', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($profissao); ?>
                            </div>
  
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="descricao">Descricao</label>
                            <div class="col-sm-4">
                                <?php echo form_textarea($descricao); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Facebook', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($rede1); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Twiter', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($rede2); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Instagram', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($rede3); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Youtube', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($rede4); ?>
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
