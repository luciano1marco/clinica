<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 align="center">Comunidade</h3>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <!--<th>Lista de Editais</th>-->
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Telefone</th>
                                    <th>Ação</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($areas as $area) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($area['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo anchor('admin/areas/edit/' . $area['id'], "<span class=\"glyphicon glyphicon-pencil\"></span>"); ?> 
                                    &nbsp;&nbsp;&nbsp;
                                        <?php echo anchor('admin/areas/delete/?id=' . $area['id'], "<span class=\"glyphicon glyphicon-trash\"></span>"); ?></td> 
                                
                                    </tr>
                                <?php endforeach; ?>  -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>