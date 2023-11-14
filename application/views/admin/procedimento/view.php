<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/pacientes' ; ?>
        <h3 class="box-title" align="center">Visualização de Impressão</h3>
    </section>
    <!------------------------------------------------------------------------------->
    <section class="content">
        <div class="row">
            <?php foreach ($procedimento as $i) : ?>
                    <!--procedimento-documento------------------------------------->
                    <?php foreach ($pacie as $p) : ?>
                    <?php endforeach; ?>    

                    <div class="col-md-12">
                        <div class="box">
                            <div class="box">
                                <h3 class="box-title" align="center"><?php echo $i['titulo']; ?>
                                &nbsp;&nbsp;de &nbsp;&nbsp;
                                <?php echo $p['nome']; ?>
                                </h3>
                                
                            </div>
                            <div class="box-body">
                            <h3><?php echo $i['descricao']; ?></h3>
                                             
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
            <?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';?>
                                 
            <?php echo anchor('admin/procedimento/imprime/'.$i['id'].'/'.$i['idpa'], "<button class=\"btn btn-primary\"><i class=\"fa fa-print\"></i> Imprimir</button>"); ?>&nbsp;&nbsp;
            <?php echo anchor($anchor1.'/view/'.$idview, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                                                         
        </div>
    </section>
    <!---------------------------------------------------------------------------------->
</div>
