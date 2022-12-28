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
                        <h3 class="box-title">Visualizar Relatórios</h3>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Geral</a></li>
                       <!-- <li><a data-toggle="tab" href="#tab2">Grupo de Risco</a></li>
                        <li><a data-toggle="tab" href="#tab3">Retorno Escolar</a></li>
                        <li><a data-toggle="tab" href="#tab4">Atividades Não Presencial</a></li>
                        <li><a data-toggle="tab" href="#tab5">Trabalho Presencial</a></li>
                        <li><a data-toggle="tab" href="#tab6">Acesso a Internet</a></li>
                        <li><a data-toggle="tab" href="#tab7">Aparelhos Tecnológicos</a></li>
                     -->   
                    </ul>

                    <div class="box-body">
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">

<!----------------------------relatorio quantidade de questionarios-->
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
                                 <!--       <div class="col-sm-6">
                                                <div id="chart-container">
                                                    <canvas id="relqdqbar"></canvas>
                                                </div>
                                            </div>
                                  -->   </div>
                                    </div>
                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                                <!-- END TAB -->

<!----------------------------relatorio quantidade de Estudantes
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Quantidade de Estudantes</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                        
                                            <div class="col-sm-6">
                                                <div id="chart-container">
                                                    <canvas id="relestudantepie"></canvas>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div id="chart-container">
                                                    <canvas id="relespecialpie"></canvas>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div>
           -->     <!-- END TAB -->
                         
<!----------------------------relatorio Grupo de Risco da Covid-19
                            <div id="tab2" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Grupo de Risco da Covid-19</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-8">
                                                <div id="chart-container">
                                                    <canvas id="relriscopie"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div>
      -->                      <!-- END TAB -->

<!----------------------------relatorio Relatório Retorno Escolar
                            <div id="tab3" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Relatório Retorno Escolar</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-sm-10">
                                                <div id="chart-container">
                                                    <canvas id="relretornobar"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">&nbsp;</div>
                                    </div>
                                    <div class="panel-body">
                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div id="chart-container">
                                                        <canvas id="relretornobar2"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                    </div>
                                 
                                    <div class="panel-body">
                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div id="chart-container">
                                                        <canvas id="relretornobar3"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                    </div>
                
                                </div>
                            </div>
      -->                              <!-- END TAB -->

<!----------------------------relatorio Estudantes Acessarem as atividades não presencial
                                    <div id="tab4" class="tab-pane fade">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3>Relatório Estudantes Acessarem as atividades não presencial</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <div id="chart-container">
                                                            <canvas id="relpresencialbar2"></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                        </div>
                                    </div>
        -->                            <!-- END TAB -->

<!----------------------------relatorio Trabalho de forma Presencial
                                    <div id="tab5" class="tab-pane fade">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3>Relatório Trabalho de forma Presencial</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div id="chart-container">
                                                            <canvas id="reltrabalhobar"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div id="chart-container">
                                                            <canvas id="reltrabalho1bar"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                        </div>
                                    </div>
       -->                            <!-- END TAB -->

<!----------------------------relatorio Acesso a Internet
                                    <div id="tab6" class="tab-pane fade">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3>Relatório Acesso a Internet</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div id="chart-container">
                                                            <canvas id="relacessobar"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div id="chart-container">
                                                            <canvas id="relacesso1bar"></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                -->                            <!-- PANEL BODY 

                                            <div class="panel-footer">&nbsp;</div>
                                        </div>
                -->                        <!-- PANEL -->

                                    </div>
                                    <!-- END TAB -->

<!----------------------------relatorio Aparelhos Tecnológicos
                                    <div id="tab7" class="tab-pane fade">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3>Relatório Aparelhos Tecnológicos</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div id="chart-container">
                                                            <canvas id="relaparelhobar"></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="panel-footer">&nbsp;</div>
                                        </div>
                                    </div>
                -->                    <!-- END TAB -->

<!----------------------------relatorio tab8-->
                                    <!-- END TAB -->

<!----------------------------relatorio tab9-->
                                    <!-- END TAB -->

<!----------------------------relatorio tab10-->
                                    <!-- END TAB -->

<!-----------fim--------------------------------->
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
</div>