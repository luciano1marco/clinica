<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<meta charset='utf-8' />
<link href='../lib/main.css' rel='stylesheet' />
<script src='../lib/main.js'></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/js/moment.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'lib/fullcalendar.js'; ?>"></script>      

<style>
	body {
		margin: 40px 10px;
		padding: 0;
		font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
		font-size: 14px;
	}
	#calendar {
		max-width: 1100px;
		margin: 0 auto;
	}
	
</style>

<div class="content-wrapper">
	<section class="content-header">
		<?php $icon = '<i class="fa fa-' . $pageicon . '"></i>'; ?>
		<?php echo $pagetitle; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 align="center">Agendamento</h3>
							</div>
                            <div class="box-header with-border">
						        <h3 class="box-title"><?php echo anchor('/admin/calendar/create', '<i class="fa fa-plus"></i> ' . $texto_btn_create, array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
							</div>
							<tbody>
								<div id='script-warning'>
									<!-- <code>php/get-events.php</code> must be running.-->
								</div>
								<div id='loading'></div>
								<div id='calendar'></div>
							</tbody>
						</div>	
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Modal create-->
	<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="POST" id="form_create">
					<input type="hidden" name="calendar_id" value="0">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Agendar um Espaço</h4>
					</div>
					
					<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form_create')); ?>

					<div class="modal-body">
					
						<div class="form-group">
								<div class="alert alert-danger" style="display: none;"></div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Nome  </label>
							<div class="col-sm-6">
								<?php echo form_dropdown($idpaciente);?>
							</div>
						
							<div class="col-sm-4">
								<?php echo anchor( '/admin/pacientes/create', '<i class="fa fa-plus"></i> ' . 'Adicionar Paciente', array('class' => 'btn btn-block btn-primary btn-flat')); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Horário</label>
							<div class="col-sm-10">
								<?php echo form_dropdown($hora);?>
							</div>
						</div>
						
						<!--	<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Cor</label>
							<div class="col-sm-10" >
								<ul class= "form-control" >
									<?php echo 	form_dropdown($color);?>
								</ul>
							</div>
						</div>
						--->
						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color</label>
							<div class="col-sm-10">
								<select name="color" class="form-control">
									<option value="">Selecione uma Cor</option>
									<option style="color:#0071c5;" value="#0071c5">&#9724; Azul escuro</option>
									<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
									<option style="color:#008000;" value="#008000">&#9724; Verde</option>                       
									<option style="color:#FFD700;" value="#FFD700">&#9724; Amarelo</option>
									<option style="color:#FF8C00;" value="#FF8C00">&#9724; Laranja</option>
									<option style="color:#FF0000;" value="#FF0000">&#9724; Vermelho</option>
									<option style="color:#b2371fc4;" value="#b2371fc4">&#9724; Marron</option>
									<option style="color:#de3ddbde;" value="#de3ddbde">&#9724; Rosa</option>
									<option style="color:#464646b5;" value="#464646b5">&#9724; Cinza</option>
									
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 col-form-label text-right" name="start_date" for="start_date">Início </label>
							<div class="col-sm-10">
								<?php echo form_input($start_date);?>
							</div>
						</div>
						<div class="modal-footer">
							<!--<a  href="javascript::void" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
								<a class="btn btn-danger delete_calendar" style="display: none;">Delete</a>
							-->
							<button type="submit" class="btn btn-primary">Enviar</button>
							<button type="reset" class="btn btn-light">Limpar</button> 
							
						</div>
						
					</div>
					<?php echo form_close(); ?>
				</form>
			</div>
		</div>
	</div>
<!-- end modal -->

	<!----form modal mostrar dados ---->
	<div id="modal_mostra" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" id="modal-dialog">
            <div class="modal-content" id="modal-content">
                <div class="modal-header" id="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="limpa_model()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Dados da Reserva:</b></h4>
                </div>

                <div class="modal-body" id="modal-body">
                    <div class="form-group">
						<label class="control-label col-sm-2" >Nome </label>
                        <div class="col-sm-10"> <input type="text" name="nome" class="form-control" readonly>
                        </div>
						<label class="control-label col-sm-2" >Telefone </label>
                        <div class="col-sm-10">
                            <input type="text" name="telefone" class="form-control" readonly>
                        </div>
						<label class="control-label col-sm-2" >Email </label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" readonly>
                        </div>
						<label class="control-label col-sm-2" >Endereço </label>
                        <div class="col-sm-10">
                            <input type="text" name="endereco" class="form-control" readonly>
                        </div>
						<label class="control-label col-sm-2" >Data</label>
                        <div class="col-sm-10">
                            <input type="text" name="start" class="form-control" readonly>
                        </div>
						<label class="control-label col-sm-2" >Horário </label>
                        <div class="col-sm-10">
                            <input type="text" name="hora" class="form-control" readonly>
                        </div>
                            <input type="hidden" name="id" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="botao" class="btn btn-primary" data-dismiss="modal">Ok</button>
					<button type="button"  id="bapaga" class="btn btn-default" onclick= apagar() data-dismiss="modal">Apagar</button>
                
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- fim modal -->

	<script type="text/javascript" src="<?php echo base_url().'assets/plugins/js/jquery.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/js/moment.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/js/bootstrap.min.js'; ?>"></script>      
	<script type="text/javascript" src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script>      
    <script type="text/javascript" src="<?php echo base_url().'lib/fullcalendar.js'; ?>"></script>      
 
<script>
		var backend_url  = '<?php echo base_url(); ?>';

		//document.addEventListener('DOMContentLoaded', function() {
		$(document).ready(function(){
				
    		var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: ''
					//--para mostras dia,mes,semana coloque isto nas aspas acima
						//  dayGridMonth,timeGridWeek,timeGridDay
					},
				initialDate: new Date(),//pega data do sistema
				navLinks: true, // can click day/week names to navigate views
				selectable: true,
				selectMirror: true,
				select: function(start,end) {
					//console.log(start.startStr);
					$('#create_modal input[name=start_date]').val(start.startStr);
                    $('#create_modal').modal('show');
					save();
				},
				eventClick: function(event, element)
					{
						mostra(event);

						//id = event.event.id;
						//console.log(id);
					},
			
				editable: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: [
					//fazer um for para buscar do banco e mostrar na tela
					<?php foreach ($agend as $ag) : ?>
						{	id   : '<?php echo $ag['id']; ?>',
							color: '<?php echo $ag['color']; ?>',
							title: '<?php echo $ag['nome'].' '.$ag['hora']; ?>',
							start: '<?php echo $ag['dtinicial']; ?>',
							
						},
					<?php endforeach; ?>
				]
			});
			calendar.render();
		});
		
		function mostra(event){
			id = event.event.id;
			//console.log(id);
			let url = backend_url+'admin/calendar/idmostra/'+id;

			//faz a requisicao para o php
    		var xhttp = new XMLHttpRequest();
			xhttp.open("GET", url, false);
			xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
			
			var dados = JSON.parse(xhttp.responseText);//arruma os dados para visualizacáo

			//muda a cor
			let div = document.getElementById('modal-header');//header
			let bot = document.getElementById('botao');//botáo ok
			let bap = document.getElementById('bapaga');//botáo apagar
			
			div.style.background = dados.color;
			bot.style.background = dados.color;
			bap.style.color = dados.color;
			//fim do muda cor
			
			//mostra os dados do paciente
			console.log(dados);
			$('#modal_mostra input[name=nome]').val(dados.nome);
			$('#modal_mostra input[name=telefone]').val(dados.telefone);
			$('#modal_mostra input[name=email]').val(dados.email);
			$('#modal_mostra input[name=endereco]').val(dados.endereco);
			$('#modal_mostra input[name=hora]').val(dados.hora);
			$('#modal_mostra input[name=start]').val(moment(dados.dtinicial).format('DD/MM/YYYY'));
			
			$("#modal_mostra").modal({show: true }); 
		}
		
		function save() {
            $('#form_create').submit(function(){
			    var dados = $(this).serialize();
				var element = $(this);
               // var eventData;
                $.ajax({
                    url     : backend_url+'admin/calendar/save',
                    type    : element.attr('method'),
                    data    : element.serialize(),
                  	success : function(data, textStatus, jqXHR){
						//alert(jqXHR+" "+ textStatus+" "+ errorThrown);
            			$('#create_modal').modal('hide');               	                        
						location.reload();
					},
					error: function (jqXHR, textStatus, errorThrown) {
						// Executado em caso de erro.
						alert(jqXHR+" - "+ textStatus+" - "+ errorThrown);
						//error();
        			}

                });
              	return false;
            })
        }
		
		function apagar(){
			if (confirm('Tem certeza que deseja apagar o Evento?')) {
				window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/deleteyes/" + id );
			}
		}
		
		function limpa_model(){
			$('#modal_mostra input[name=nome]').val('');
			$('#modal_mostra input[name=hora]').val('');
			$('#modal_mostra input[name=start]').val('');
          
		}
		
		function htmlEscape(s) {
			return (s + '').replace(/&/g, '&amp;')
				.replace(/</g, '&lt;')
				.replace(/>/g, '&gt;')
				.replace(/'/g, '&#039;')
				.replace(/"/g, '&quot;')
				.replace(/\n/g, '<br />');
		}

</script>