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
                        <h3 class="box-title"><?php echo lang('users_edit_user'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message;?>

                        <?php echo form_open(uri_string(), array('class' => 'form-horizontal', 'id' => 'form-edit_user')); ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="controller">Controlador</label>
                                <div class="col-sm-10">
                                    <?php echo form_input($controller);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="descricao">Descrição</label>
                                <div class="col-sm-10">
                                    <?php echo form_input($descricao);?>
                                </div>
                            </div>

                            <div class="form-group">                                           
                            <label class="col-sm-2 control-label" for="icone">Ícone</label>
                                <div class="col-sm-10">                                   
                                    <?php echo form_dropdown($icone);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="section">Sessão</label>
                                <div class="col-sm-10">
                                    <?php echo form_dropdown($section);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Grupos</label>
                                <div class="col-sm-10">
                                <?php foreach ($groups as $group):?>
                                <?php
                                    $checked = NULL;
                                    $item    = NULL;

                                    foreach($currentGroups as $grp):
                                        if ($group['id'] == $grp->grupo) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    endforeach;
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="groups[]" class ="icheck" value="<?= $group['id'];?>"<?= $checked; ?>>
                                            &nbsp;<?= ucfirst($group['name']) ?>
                                        </label>
                                    </div>

                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="publicado">Publicado</label>                                        
                                <div class="col-sm-10">
                                    <?php echo form_checkbox($publicado);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?php echo form_hidden('id', $id);?>
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
                                        <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, "id" => "btExcluir")); ?>
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

<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atenção!</h4>
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