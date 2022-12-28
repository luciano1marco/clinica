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
                        <h3 class="box-title"><?php echo $texto_edit; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                        
                        <?php echo form_fieldset('Dados'); ?>

                        <div class="form-group">
                            <?php echo form_label('Nome', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($nome); ?>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <?php echo form_label('Telefone', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($telefone); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Profissao', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($profissao); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Descricao', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($descricao); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Facebook', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($rede1); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Twiter', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($rede2); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Instagram', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($rede3); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Youtube', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
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
                                      $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';
                                    ?>

                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>
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


<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Atenção!</b></h4>
            </div>

            <div class="modal-body">
                <p>Deseja realmente excluir esse registro?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar">Excluir</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->