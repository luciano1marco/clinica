<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php $anchor = 'admin/'.$this->router->class; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                <div class="col-sm-6">
                    <h1><?php echo $pagetitle; ?></h1>
                </div>
                 
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard"><i class="fa fa-tachometer-alt"></i> Painel Principal</a></li>
                    <li class="breadcrumb-item">Arquivos</li>
                    <li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
                    </ol>
                </div>
            </div>
        </div>
       
        <input type="hidden" id="id" name="id" value= "<?php echo $dado['id']; ?>">
        
        <!-- /.container-fluid -->
        </section>
        
        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">     
                        <h3 class="card-title">Anexar Foto 3x4     
                    

                    </div>
                    <div class="card card-primary card-outline">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="title">   
                            <?php echo anchor('/admin/dados/',"Voltar", array('class' => 'btn btn-primary btn-flat no-print')); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalfotos">
                                Anexar Arquivo
                            </button>
                        </div>
                    </div>

                    <?php $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';?>
                    <?php $view = '<i class="fa fa-search"></i> <span>Ver</span>';?>  
                    
                    <div class="card-body">
                        <?php foreach ($fotos as $arq) { ?>
                            <div class="card-row">
                                    <a target="blank" href="<?= base_url("upload/arquivos/foto-".$dado->id."/".$arq['arquivo'].'.html') ?>"> <?= $arq['arquivo'] ?> </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <!-- <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, 'id' => "btExcluir")); ?>
                                    --><?php echo anchor($anchor.'/apagararquivoestagio/'.$arq['id'], $delete, array('class' => 'btn btn-danger')); ?> 
							
                            </div>
                        <?php } ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modal anexar arquivoetapa -->
<div class="modal" id="modalfotos">
<form enctype="multipart/form-data" id="fotos" method="post" action="<?= base_url("/admin/dados/upload/".$dado->id) ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Anexar Arquivo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  ><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <label>Selecione os arquivos (Tamanho máximo: 5 MB)</label>
                <input type="file" name="fotos[]" multiple />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Enviar" />
            </div>
        </div>
    </div>
</form>
</div>

 <!-- modal excluir arquivo-->            
 <div class="modal fade" id="modal_delete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atenção!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Deseja realmente excluir esse registro?</p>
                </div>

                <div class="modal-footer justify-content-between">
                <?php                                               
                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                     
                $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';                               
                ?>
                
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $cancel; ?></button>
                <button type="button" class="btn btn-danger" id="btExcluirarquivo"><?php echo $delete; ?></button> 
                
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->    