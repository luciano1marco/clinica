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
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			initialDate: '2021-02-10',
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectMirror: true,
			select: function(arg) {
				var title = prompt('Digite um Evento:');
				if (title) {
				calendar.addEvent({
					title: title,
					start: arg.start,
					end: arg.end,
					allDay: arg.allDay
					})
				}
				calendar.unselect()
				//--colocar aqui se eu quiser gravar no banco
			},
			eventClick: function(arg) {
				if (confirm('Tem certeza que deseja apagar o Evento?')) {
				arg.event.remove()

				//-- colocar aqui se eu quiser deletar do banco	
				}
			},
			editable: true,
			dayMaxEvents: true, // allow "more" link when too many events
			events: [
				//fazer um for para buscar do banco e mostrar na tela
				<?php foreach ($evento as $ag) : ?>
					{
					title: '<?php echo $ag['title'].' '.$ag['hora']; ?>',
					start: '<?php echo $ag['start']; ?>',
				
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
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>


	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 align="center">Calendário</h3>

							</div>
						</div>

					</div>
					
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<tbody>

							<div id='script-warning'>
							<!--	<code>php/get-events.php</code> must be running.-->
							</div>
							<div id='loading'></div>

							<div id='calendar'></div>
								
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</section>

</div>