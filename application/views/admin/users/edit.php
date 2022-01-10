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
                                <?php echo lang('users_firstname', 'first_name', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($first_name);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('users_lastname', 'last_name', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($last_name);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('users_company', 'company', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($company);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('users_phone', 'phone', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($phone);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('users_password', 'password', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($password);?>
                                    <div class="progress" style="margin:0">
                                        <div class="pwstrength_viewport_progress"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('users_password_confirm', 'password_confirm', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-10">
                                    <?php echo form_input($password_confirm);?>
                                </div>
                            </div>

                            <?php if ($this->ion_auth->is_admin()): ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo lang('users_member_of_groups');?></label>
                            <div class="col-sm-10">

                            <?php foreach ($groups as $group):?>

                            <?php
                            $gID     = $group['id'];
                            $checked = NULL;
                            $item    = NULL;

                            foreach($currentGroups as $grp) {
                                if ($gID == $grp->id) {
                                    $checked = ' checked="checked"';
                                    break;
                                }
                            }
                            ?>
                            
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="groups[]" class="icheck pl-2" value="<?php echo $group['id'];?>"<?php echo $checked; ?>>
                                        <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </label>
                                </div>

                                <?php endforeach?>
                                
                            </div>
                            </div>
                            <?php endif ?>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <?php echo form_hidden('id', $user->id);?>
                                    <?php echo form_hidden($csrf); ?>
                                    <div class="btn-group">
                                
                                    <?php
                                    $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';                                                                              
                                    $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                    $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
                                    ?>

                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>    
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
                <h4 class="modal-title"><b>Atenção!</b></h4>
            </div>

            <div class="modal-body">
                <p>Deseja realmente excluir esse registro?</p>
            </div>

            <div class="modal-footer">            
                <?php                                               
                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                     
                $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';                               
                ?>

                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $cancel; ?></button>
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar"><?php echo $delete; ?></button> 
                               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->