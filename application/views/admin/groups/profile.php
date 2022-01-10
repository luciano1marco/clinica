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
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
					<h4><p class="text-center">DADOS</p></h4>
					</div>

					<div class="box-body">
						<table class="table table-striped table-hover">
							<tbody>               

							<?php echo form_hidden('id', $groups->id);?>

                            <?php if(isset($groups->id) && isset($groups->name) ): ?>    
                            <?php
                            $name = htmlspecialchars($groups->name, ENT_QUOTES, 'UTF-8');
                            $description = htmlspecialchars($groups->description, ENT_QUOTES, 'UTF-8');
                            $bgcolor = htmlspecialchars($groups->bgcolor, ENT_QUOTES, 'UTF-8');
                            ?>
                                                                           
								<tr>
									<th><?php echo 'Nome do Grupo'; ?></th>
                                    <td><?php echo $name; ?></td>                                   
                                </tr>
                               
								<tr>
									<th><?php echo 'Descrição do Grupo'; ?></th>
									<td><?php echo $description; ?></td>
								</tr>
								<tr>
									<th><?php echo 'Cor do Grupo'; ?></th>                                   
                                    <td><i class="fa fa-stop" style="color:<?php echo $bgcolor; ?>"></i></td>
                                </tr>
                                								
							<?php endif; ?>
							</tbody>
						</table>
					</div>

					<br>

					<div class="row text-center">
					<?php					
					$edit = '<i class="fa fa-edit"></i> <span>Editar</span>';					
					$delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
					?>
					
					<?php echo anchor($anchor.'/edit/'.$groups->id, "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
					&nbsp;					
					<?php //echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, "id" => "btExcluir")); ?>
					</div>

					<br>

				</div>
				</div>
			
            <!-- PAINEL EXTRA -->	
            <!--			
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">xxxx</h3>
					</div>
				    <div class="box-body">
				    </div>
				</div>
			</div>
			-->

		</div>
	</section>
</div>

<?php
/*
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
*/
?>