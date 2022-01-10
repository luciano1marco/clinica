<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/'.$this->router->class; ?>
	</section>

	<div style="margin-top: 8px" id="alert_message">
	<?php
	if($this->session->userdata("message") != null)
	{
	?>
		<div class="alert alert-info alert-dismissable" role="alert">
			<?php echo $this->session->userdata("message"); ?> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php
	}
	?>
	</div>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor('admin/sections/create', '<i class="fa fa-plus"></i> Nova Sessão de Menu', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<th>Descrição</th>
									<th>Publicado</th>	
									<th>Açoes</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sections as $i):?>
								<?php 
									$descricao = $i['descricao'];
									$publicado = $i['publicado'];
									$id = $i['id'];
									// Para usar ID depois							
									$id_check['value'] = $i['id'];

									$sim = '<span class="label label-success">SIM</span>';
									$nao = '<span class="label label-default">NÃO</span>';
									?>
									
									<tr>
										<!--<td><?php echo form_checkbox($id_check);?></td>-->			
										<!--<td><?php echo $descricao; ?></td>-->
																		
										<td><?php echo anchor($anchor.'/profile/'.$i['id'], $descricao); ?></td>
										<!-- Publicado -->
										<td>											
											<?php echo ($publicado) ? anchor($anchor.'/deactivate/'.$id, $sim) : anchor($anchor.'/activate/'. $id, $nao); ?>
										</td>
										<!-- Opções -->                                            
										<td>
											<?php echo anchor($anchor.'/edit/'.$i['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
										</td>
									</tr>	

								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
