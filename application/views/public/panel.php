<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo $modulo_cabecalho; ?>
<?php echo $modulo_menu; ?>

<?php $anchor = 'public/'.$this->router->class; ?>

<body>

    <main role="main" class="container">
        <div class="jumbotron">
            <h1>Questionario - PMRG</h1>        
        </div>    	   
    </main>

    <?php 
    if(!empty($this->session->flashdata('message'))) { 
    ?>
    
    <script>
       $(document).ready(function() {
            $('#modalsucesso').modal('show');
        });
    </script>
    
    <?php } ?>

    <section class="container m-t-lg">
    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
        <div class="row clearfix"></div>
       
        <!--col-md-12 column-->
        <div class="col-md-12 column">

        <!-- ERROS -->
        <div style="margin-top: 8px" id="alert_message">
	    <?php
	    if($this->session->userdata("message") != null OR !empty(validation_errors()))
	    {
	    ?>

		<div class="alert alert-info alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?php echo $this->session->userdata("message"); ?> 
            <?php echo validation_errors(); ?> 			
        </div>
        
	    <?php
	    }
	    ?>
        </div>
        <!-- ERROS -->

        <?php echo $questionario_panel; ?>
                    
        <?php
        $submit     = '<i class="fa fa-check"></i> <span>Enviar</span>';               
        $redo       = '<i class="fa fa-refresh"></i> <span>Reiniciar</span>';             
        $cancel     = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
        ?>

            <div class="row text-center m-b-lg">               
                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat btn-lg float-right', 'content' => $submit)); ?>                            
            </div>

        </div>    
        <!--col-md-12 column-->
       
    <div class="row clearfix"></div>

    <?php echo form_close();?>
    </section>    

    <!-- Modal -->
    <div class="modal fade" id="modalsucesso" tabindex="-1" role="dialog" aria-labelledby="modalsucesso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">            
            <div class="modal-header">
                <h4 class="modal-title" id="modalsucesso">SUCESSO
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </h4>
            </div>

            <div class="modal-body">
                <?php echo $this->session->flashdata('message'); ?>               
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>           
            </div>
        
        </div>
    </div>
    </div>

   
</body>

<?php echo $modulo_rodape; ?>

</html>