<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Visualizar Gráficos</h3>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Por Mês</a></li>
                        <li><a data-toggle="tab" href="#tab2">Por Paciente</a></li>
                        <!--  <li><a data-toggle="tab" href="#tab3">Retorno Escolar</a></li>
                        <li><a data-toggle="tab" href="#tab4">Atividades Não Presencial</a></li>
                        <li><a data-toggle="tab" href="#tab5">Trabalho Presencial</a></li>
                        <li><a data-toggle="tab" href="#tab6">Acesso a Internet</a></li>
                        <li><a data-toggle="tab" href="#tab7">Aparelhos Tecnológicos</a></li>
                         -->   
                    </ul>

                    <div class="box-body">
                        <div class="tab-content">
                            <!------relatorio total por mes tab1-->
                                <div id="tab1" class="tab-pane fade in active">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3>Total de Atendimentos por mês</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div id="chart-container">
                                                            <canvas id="relmes"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                        </div>
                                </div>
                            <!-- END TAB1 -->
                            <!--Relatorio por serie  tab2-->
                                <div id="tab2" class="tab-pane fade">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Total de Atendimento por Paciente</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div id="chart-container">
                                                        <canvas id="relpaciente"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">&nbsp;</div>
                                    </div>
                                </div>
                            <!-- END TAB2 -->
                        </div>
                    </div>
                </div>
            </div> 
        </div>           
    </section>
</div><!--fim content-wrapper--->