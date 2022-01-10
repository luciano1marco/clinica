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
                        <h3 class="box-title">Usuários da Rede</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-center"><strong>xxx</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center text-uppercase"><strong>Resources</strong></p>
                                <div class="progress-group">
                                    <span class="progress-text">SMS</span>
                                    <span class="progress-number"><strong><?php echo byte_format($disk_usespace, 2); ?></strong>/<?php echo byte_format($disk_totalspace, 2); ?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="<?php echo $disk_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $disk_usepercent; ?>%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">SMED</span>
                                    <span class="progress-number"><strong><?php echo byte_format($memory_usage, 2); ?></strong>/<?php echo byte_format($memory_peak_usage, 2); ?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $memory_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memory_usepercent; ?>%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">SMCAS</span>
                                    <span class="progress-number"><strong><?php echo byte_format($memory_usage, 2); ?></strong>/<?php echo byte_format($memory_peak_usage, 2); ?></span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $memory_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memory_usepercent; ?>%"></div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>