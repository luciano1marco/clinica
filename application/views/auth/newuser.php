<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<body class="hold-transition login-page fullpage">
    <div class="login-box">
                
        <div class="login-box-body">
            <p class="login-box-msg"><strong>Cadastre o Novo Usuário</strong></p>            
            <?php $anchor = 'admin/'.$this->router->class; ?>
            <?php echo $message;?>
         
            <?php echo form_open('auth/newuser');?>

                    <label class="col-sm-10 control-label" for="nomecompleto">Nome Completo</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($nomecompleto);?>
                    </div>

                    <label class="col-sm-10 control-label" for="cpf">CPF</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($cpf);?>
                    </div>

                    <label class="col-sm-10 control-label" for="email">E-mail</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($email);?>
                    </div>

                    <label class="col-sm-10 control-label" for="email2">Confirmar E-mail</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($email2);?>
                    </div>

                    <label class="col-sm-10 control-label" for="password">Password</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($password);?>
                    </div>

                    <label class="col-sm-10 control-label" for="password">Password Confirmar</label>

                    <div class="form-group has-feedback">
                        <?php echo form_input($password2);?>
                    </div>
                           
                    <div class="form-group">   
                                 
                        <div class="btn-group col-md-offset-1">
                       
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
                <?php echo form_close();?>
        </div>
       
    </div>