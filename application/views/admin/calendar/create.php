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

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>

                        <?php echo form_fieldset('Dados'); ?>

                        <div class="form-group">
							<label class="control-label col-sm-2">Nome  </label>
							<div class="col-sm-3">
								<?php echo form_dropdown($idpaciente);?>
							</div>
						</div>
                        
                        <div class="form-group">
                        <label class="col-sm-2 control-label" for="hora">Horário</label>
                            <div class="col-sm-3">
                                <?php echo form_dropdown($hora); ?>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color</label>
							<div class="col-sm-3">
								<select name="color" class="form-control">
									<option value="">Selecione uma Cor</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
									<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
									<option style="color:#008000;" value="#008000">&#9724; Green</option>                       
									<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
									<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
									<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
								</select>
							</div>
						</div>

                        <div class="form-group row">
							<label class="col-sm-2 col-form-label text-right" name="start_date" for="start_date">Início </label>
							<div class="col-sm-3">
								<?php echo form_input($start_date);?>
							</div>
						</div>

                        <?php echo form_fieldset_close(); ?>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
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