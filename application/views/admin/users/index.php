<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>

	<!-- FLASH MESSAGE -->
	<div style="margin-top: 8px" id="alert_message">
		<?php
		if ($this->session->userdata("message") != null) {
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
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 align="center">Usuários</h3>

							</div>
						</div>

					</div>

					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor('admin/users/create', '<i class="fa fa-plus"></i> ' . lang('users_create_user'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th><?php echo lang('users_firstname'); ?></th>
									<th><?php echo lang('users_lastname'); ?></th>
									<th><?php echo lang('users_email'); ?></th>
									<th><?php echo lang('users_groups'); ?></th>
									<th><?php echo lang('users_status'); ?></th>
									<th><?php echo lang('users_action'); ?></th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($users as $user) : ?>
									<tr>
										<?php
										$first_name = htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8');
										$last_name = htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8');
										$email = htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8');

										$data = array(
											'name'          => 'id',
											'id'            => 'id',
											'value'         => $user->id,
											'class'			=> 'icheck',
											'checked'       => FALSE,
											'style'         => 'margin:10px'
										);
										?>
										<!--<td><?php echo $first_name; ?></td>-->
										<!--<td><?php echo form_checkbox($data); ?></td>-->

										<td><?php echo anchor($anchor . '/profile/' . $user->id, $first_name); ?></td>
										<td><?php echo $last_name; ?></td>
										<td><?php echo $email; ?></td>

										<td>
											<?php
											foreach ($user->groups as $group) :
												$group_name = htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); {
													echo anchor('admin/groups/edit/' . $group->id, '<span class="label label-default">' . $group_name . '</span>');
												}
											?>
										</td>
									<?php endforeach; ?>

									<td><?php echo ($user->active) ? anchor('admin/users/deactivate/' . $user->id, '<span class="label label-success">' . lang('users_active') . '</span>') : anchor('admin/users/activate/' . $user->id, '<span class="label label-default">' . lang('users_inactive') . '</span>'); ?></td>

									<!-- Opções -->
									<td>
										<?php echo anchor($anchor . '/edit/' . $user->id, "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
										<span>&nbsp;</span>
										<?php echo anchor($anchor . '/profile/' . $user->id, "<button class=\"btn btn-primary\"><i class=\"fa fa-search\"></i> Ver</button>"); ?>
									</td>
									</tr>
								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>