<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <title><?php echo $title; ?></title>

        <!-- IE8 -->
        <?php if ($mobile === FALSE): ?>
                <!--[if IE 8]>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <![endif]-->
        <?php else: ?>

        <meta name="HandheldFriendly" content="true">

        <?php endif; ?>

        <?php if ($mobile == TRUE && $mobile_ie == TRUE): ?>
                <meta http-equiv="cleartype" content="on">
        <?php endif; ?>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">

        <?php if ($mobile == TRUE && $ios == TRUE): ?>
        
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?php echo $title; ?>">

        <?php endif; ?>

        <?php if ($mobile == TRUE && $android == TRUE): ?>
            <meta name="mobile-web-app-capable" content="yes">
        <?php endif; ?>

        <?php
        $methods_array = array('create','edit','view','index');
        ?>
        <!-- FONTES -->
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        
        <!-- BASICO ADMINLTE -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/skins/skin-blue.min.css'); ?>">
        
        <!-- ICHECK e LIGHT BOX -->
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/icheck/skins/square/blue.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/lightbox2/css/lightbox.min.css'); ?>">
        
        <!--select2 --->
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/select2.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/themes/select2-bootstrap.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/themes/select2-flat-theme.css'); ?>"> 

        <!-- DATATABLES -->
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/datatables/datatables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/css/custom_admin.css'); ?>">

        <!-- ANIMSITION TRANSITIONS -->
        <?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
            <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/animsition/animsition.min.css'); ?>">
        <?php endif; ?>

        <!-- COLORPICKER -->
        <?php
        $colorpicker_array = array('groups');       
        $include_colorpicker = isset($includes['colorpicker']) ? $includes['colorpicker'] : array();
        ?>

        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$colorpicker_array) || in_array($this->router->fetch_class(), $include_colorpicker)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>
      
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.css'); ?>">
               
        <?php endif; ?>

        <!-- SELECT2 e SELECT-BOOTSTRAP -->
        <?php
        $select_bt_array = array('menuitens');  
        $include_select2 = isset($includes['select2']) ? $includes['select2'] : array();     
        ?>

        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$select_bt_array) || in_array($this->router->fetch_class(), $include_select2)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>

        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap_select/bootstrap-select.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/select2.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/themes/select2-bootstrap.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/select2/css/themes/select2-flat-theme.css'); ?>"> 
                
        <?php endif; ?>
        
        <!-- DATETIMEPICKER -->    
        <?php
        $datepicker_array = array('');       
        $include_datepicker = isset($includes['datepicker']) ? $includes['datepicker'] : array();     
        ?>
      
        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$datepicker_array) || in_array($this->router->fetch_class(), $include_datepicker)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>                        
       
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.css'); ?>">
        <?php endif; ?>

        <!-- LEAFLET --> 
        <?php
        $leaflet_array = array('');    
        $include_leaflet = isset($includes['leaflet']) ? $includes['leaflet'] : array();        
        ?>
   
        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$leaflet_array) || in_array($this->router->fetch_class(), $include_leaflet)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>     

        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.css');?>" />     
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.css');?>" />    
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/MarkerCluster.Default.css');?>" />             
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.css');?>" />
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/map.css');?>" />

        <?php endif; ?>

        <!-- CHARTJS -->
        <?php
        $chartjs_array = array('');       
        $include_chartjs = isset($includes['chartjs']) ? $includes['chartjs'] : array();
        ?>

        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$chartjs_array) || in_array($this->router->fetch_class(), $include_chartjs)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>
      
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/chartjs/Chart.min.css'); ?>">
               
        <?php endif; ?>

        <!-- FRAMEWORK -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/domprojects/css/dp.min.css'); ?>">
        
        <!-- NO MOBILE -->
        <?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
        <![endif]-->
	    <?php endif; ?>
	
    </head>

    <body class="hold-transition skin-blue fixed sidebar-mini">
    
    <!-- Inputs para passar o BASE URL e Controller para o JS -->
    <input type="hidden" id="base_url" value="<?= base_url() ?>" />
    <input type="hidden" id="controlador" value="<?= $this->router->class ?>" />

    <?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <div class="wrapper animsition">
    <?php else: ?>
        <div class="wrapper">
    <?php endif; ?>

    <!-- FIX JS -->
    <script src="<?php echo base_url('public/javascript/fix_head.js'); ?>"></script>            