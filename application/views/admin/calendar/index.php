<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<meta charset='utf-8' />
<link href='../lib/main.css' rel='stylesheet' />
<script src='../lib/main.js'></script>

<script>

		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: ''
				//--para mostras dia,mes,semana coloque isto nas aspas acima
				//  dayGridMonth,timeGridWeek,timeGridDay
			},
			initialDate: '2021-02-10',
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectMirror: true,
			select: function(arg) {
			
				calendar.unselect()
			},
			
			// -- remove evento
			eventClick: function(arg) {
				if (confirm('Tem certeza que deseja apagar o Evento?')) {
				arg.event.remove(),
				
			// ---para pegar o valor da hora marcada	
				nome = arg.event._def.title,
				result = nome.split(" "),
				x = result.length - 1,
				hora = result[x],
			//--para pegar a data:
				data1 = arg.event._instance.range.start,	
				dt = data1.toLocaleDateString(),
				dta = dt.split("/"),
				dtf = [dta[2],dta[1],dta[0]], 
				dt0 = parseInt(dtf[2]),
				dt0 = dt0 + 1,
				dtf[2] = dt0.toString(),
				dtfim =dtf.join("-"),
			//mostra no console
			//	console.log(dtfim),
			//	console.log(hora)

				window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/deleteyes/" + dtfim + "/" + hora );
				
				}
			},
			
			
			editable: true,
			dayMaxEvents: true, // allow "more" link when too many events
			events: [
				//fazer um for para buscar do banco e mostrar na tela
				<?php foreach ($agend as $ag) : ?>
					{
					title: '<?php echo $ag['nome'].' '.$ag['hora']; ?>',
					start: '<?php echo $ag['dagenda']; ?>',
				
					},

				<?php endforeach; ?>	
			]
			});

			calendar.render();
		});
</script>

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
									<!--	<code>php/get-events.php</code> must be running.-->
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
