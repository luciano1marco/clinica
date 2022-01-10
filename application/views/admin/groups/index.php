<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php  $anchor = 'admin/'.$this->router->class; ?>
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
                        <h3 class="box-title"><?php echo anchor('admin/groups/create', '<i class="fa fa-plus"></i> '. lang('groups_create'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th><?php echo lang('groups_name');?></th>
                                    <th><?php echo lang('groups_description');?></th>
                                    <th><?php echo lang('groups_color');?></th>
                                    <th><?php echo lang('groups_action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($groups as $values):?>

                                <?php 
										$name = htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8');
										$description = htmlspecialchars($values->description, ENT_QUOTES, 'UTF-8');		
																			
										$data = array(
											'name'          => 'id',
											'id'            => 'id',
											'value'         => $values->id,
											'class'			=> 'icheck',
											'checked'       => FALSE,
											'style'         => 'margin:10px'
										);							
								?>
									<!--<td><?php echo $name; ?></td>-->
									<!--<td><?php echo form_checkbox($data);?></td>-->												
																				
                                <tr>
                                    <td><?php echo anchor($anchor.'/profile/'.$values->id,$name); ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><i class="fa fa-stop" style="color:<?php echo $values->bgcolor; ?>"></i></td>
                                  
									<!-- Opções -->                                            
									<td>
									    <?php echo anchor($anchor.'/edit/'.$values->id, "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
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
