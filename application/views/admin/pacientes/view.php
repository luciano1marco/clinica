<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <h3 class="box-title" align="center">Atendimento Psicológico</h3>

    </section>

    <!------------------------------------------------------------------------------->
    <section class="content">
        <div class="row">
            <?php foreach ($paciente as $pac) : ?>
                 <!--dados do paciente ------------------------------------------>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box">
                            <h3 class="box-title">Dados do Paciente
                            &nbsp;&nbsp;
                            <?php $voltar = '<i class="fa fa-times"></i> <span>Voltar</span>';?>
                            <?php if ($pac) { ?>
                                <?php echo anchor('admin/pacientes/edit/'.$pac['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>&nbsp;&nbsp;
                                <?php echo anchor('admin/pacientes/', "<button class=\"btn btn-primary\"><i class=\"fa fa-reply\"></i> Voltar</button>"); ?>
                            <?php } ?>
                            </h3>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <label class="col-sm-4">Nome</label>
                                <div class="col-sm-8">
                                    <p> <?= $pac['nome'] ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Endereço</label>
                                <div class="col-sm-8">
                                    <p><?= ($pac['endereco']); ?>&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Telefone</label>
                                <div class="col-sm-8">
                                    <p><?= ($pac['telefone']); ?>&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">CPF</label>
                                <div class="col-sm-8">
                                    <p><?= ($pac['cpf']); ?>&nbsp;</p>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4">E-mail</label>
                                <div class="col-sm-8">
                                    <p><?= ($pac['email']); ?>&nbsp;</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--descricao------------------------------------------------------->
                    <div class="col-md-6">
                            <div class="box">
                                <h3 class="box-title">Descrição
                                    &nbsp;&nbsp;
                                    <?php if ($pac) { ?>
                                        <?php echo anchor('admin/descatende/create/'.$pac['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Criar</button>"); ?>&nbsp;&nbsp;
                                    <?php } ?>
                                </h3>
                           <?php foreach ($descri as $ds) : ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><?= ($ds['descricao']); ?></p>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <h3 class="box-title">Data de Inicio</h3>
                                
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p><?= ($ds['datadesc']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    &nbsp;&nbsp; 
                                    <?php  echo anchor('admin/descatende/edit/' .$ds['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>");?> 
                                <?php endforeach; ?>    
                            </div>
                                            
                    </div>
                <!--procedimento-------------------------------------->
                
                <div class="col-md-12">
                    <div class="box">
                        <div class="box">
                            <h3 class="box-title">Procedimento
                            &nbsp;&nbsp;
                            <?php if ($pac) { ?>
                                <?php echo anchor('admin/procedimento/create/'.$pac['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Criar</button>"); ?>&nbsp;&nbsp;
                            <?php } ?>
                            </h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Data do Procedimento</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($procedimento as $pr) : ?>
                                        <tr>
                                            <td><?php echo $pr['descricao']; ?></td>
                                            <td><?php echo $pr['dataproc']; ?></td>

                                            <!-- Opções -->
                                            <td>
                                                <?php echo anchor('admin/procedimento/edit/'.$pr['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>&nbsp;&nbsp;
                                            </td>  
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--analises ------------------------------------------->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box">
                            <h3 class="box-title">Analises 
                            &nbsp;&nbsp;
                            <?php if ($pac) { ?>
                                <?php echo anchor('admin/analises/create/'.$pac['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Criar</button>"); ?>&nbsp;&nbsp;
                            <?php } ?>
                            </h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Data da Anlise</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($analise as $an) : ?>
                                        <tr>
                                            <td><?php echo $an['descricao']; ?></td>
                                            <td><?php echo $an['danalise']; ?></td>

                                            <!-- Opções -->
                                            <td>
                                                <?php echo anchor('admin/analises/edit/'.$an['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>&nbsp;&nbsp;
                                            </td>  
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--conclusão do atendimento  -->                
                
                <div class="col-md-12">
                       
                       <div class="box">
                           <h3 class="box-title">Conclusão do Atendimento
                               &nbsp;&nbsp;
                               <?php if ($pac) { ?>
                                   <?php echo anchor('admin/conclusao/create/'.$pac['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Criar</button>"); ?>&nbsp;&nbsp;
                                   
                               <?php } ?>
                           </h3>
                           <?php foreach ($conclusao as $co) : ?>
                               <div class="row">
                                   <div class="col-sm-12">
                                       <p><?= ($co['descricao']); ?></p>
                                   </div>
                                </div>
                                &nbsp;&nbsp; &nbsp;
                           <?php echo anchor('admin/conclusao/edit/' .$co['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>&nbsp;&nbsp;
                       
                           <div class="box">
                               <h3 class="box-title">Data Final</h3>
                          
                               <div class="row">
                                   <div class="col-sm-12">
                                       <p><?= ($co['dataconc']); ?></p>
                                   </div>
                               </div>
                           </div>
                           </div>
               </div>
           <?php endforeach; ?>
                
         <?php endforeach; ?>
        </div>
    </section>
    <!---------------------------------------------------------------------------------->
</div>

<!----Modal para deletar usuariorede----------------------------------------------------->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atenção!</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir esse registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar">Excluir</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->