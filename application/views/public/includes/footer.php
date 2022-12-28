<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--teste de footer-- #350B31--->    
<style>
    #myFooter {
        background:#000000b8;
        color: white;
        padding-top: 0px;
    }

    #myFooter .row {
        margin-bottom: 60px;
    }

    #myFooter .navbar-brand {
        margin-top: 45px;
        height: 65px;
    }

    #myFooter ul {
        list-style-type: none;
        padding-left: 0;
        line-height: 1.7;
    }

    #myFooter a {
        color: #d2d1d1;
        text-decoration: none;
    }

    #myFooter a:hover,
    #myFooter a:focus {
        text-decoration: none;
        color: white;
    }


    #myFooter .btn {
        color: white;
        background-color: #d84b6b;
        border-radius: 20px;
        border: none;
        width: 50px;
        display: block;
        margin: 0 auto;
        
        line-height: 25px;
    }
    #myFooter .span{
        margin-top: 50;
    }

    @media screen and (max-width: 767px) {
        #myFooter {
            text-align: center;
        }
    }


    /* CSS used for positioning the footers at the bottom of the page. */
    /* You can remove this. */

    html{
        height: 100%;
    }

    body{
        display: flex;
        display: -webkit-flex;
        flex-direction: column;
        -webkit-flex-direction: column;
        height: 100%;
    }

    .content{
    flex: 1 0 auto;
    -webkit-flex: 1 0 auto;
    min-height: 100px;
    }

    #myFooter{
    flex: 0 0 auto;
    -webkit-flex: 0 0 auto;
    }
    #direito{
        margin-top: 300;
    }
    div.topo {
        background:#265476;
        position: fixed;
        bottom: 25px;
        right: 25px;
        /*tentar usar z-index para aparecer apartir da segunda pagina*/
    }
    #myFooter h3 {
        font-weight: bold;
        font-size: 30px;
        text-align: center;
        margin-top: 30px;
        color: #992691;
    }
    #myFooter h4 {
        font-weight: bold;
        font-size: 35px;
        text-align: center;
        margin-top: 30px;
        color: #FB893B;
    }
    #myFooter h5 {
        
        font-size: 17px;
        text-align: left;
        margin-top: 30px;
        color: #FFFFFF;
    }
    span{
        background-color:#000;
        color:#FFFFFF;
    }
    .map-responsive{
        overflow:hidden;
        padding-bottom:56.25%;
        position:relative;
        height:0;
    }

    .map-responsive iframe{
        left:0;
        top:0;
        height:100%;
        width:100%;
        position:absolute;
    }
</style> 
   <footer id="myFooter">
       <div class="row"> </div>
        <div class="content-fluid">
            <div class="col-sm-3">
                <a href="#">
                    <img class="img-responsive" src="public/images/ppbr.png" width="240" height="240" >
                </a>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                <h5>Luciano Correa Marco</h5>
                    <h5>Cassino - Rio Grande - Rio Grande do Sul</h5>
                    <h5>WhatsApp: (53)984321028 </h5>
                </div>
                <div class="col-sm-6">
                    <h5>Localização - Cassino</h5>
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27015.773705039464!2d-52.17083725821855!3d-32.178037499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9511860738879071%3A0x4667872adf766709!2sCassino%20-%20Rio%20Grande%2C%20RS%2C%2096206-040!5e0!3m2!1spt-BR!2sbr!4v1668690186657!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>        
            </div>
      <!----      <div class="col-md-3" id="sociais">
                        <span><h4>
                        <ul class="list-inline">
                                <li><a target="_blank" href="https://www.facebook.com/PrefeituraMunicipaldoRG" class="facebook"> <i class="fa fa-facebook" > </i></a></li>
                                <li><a target="_blank" href="https://twitter.com/PMRGoficial"                  class="twitter">  <i class="fa fa-twitter" >  </i></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/prefeituradoriogrande/?igshid=mp5sdc6oejlu" class="instagram"><i class="fa fa-instagram"> </i></a></li>
                                <li><a target="_blank" href="https://www.youtube.com/channel/UCeCOe03FRXNUGfOE1VO0lwQ/videos"  class="youtube">  <i class="fa fa-youtube" >  </i></a></li>
                            </ul>
                        </h4></span>
                    </div>----->
            </div>
        <div class="topo">
            <a href="#topo"><i class="fa fa-angle-up" > </i></a>
        </div>
        
    </footer>
   
    <span> Todos direitos reservados ₢2022 - @luciano1marco </span> 
    <!-- END -->

    <!-- BASICO -->
    <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>   
  
    <!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url($plugins_dir . '/jquery-validate/jquery.validate.min.js'); ?>"></script>

    <!-- MASK -->
    <script src="<?php echo base_url($plugins_dir . '/jquery-mask/jquery.mask.min.js'); ?>"></script>
    
    <!-- ICHECK -->
    <script src="<?php echo base_url($plugins_dir . '/icheck/icheck.min.js'); ?>"></script>
     
    <!-- DATATABLES -->
    <script src="<?php echo base_url($plugins_dir . '/datatables/datatables.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/datatables/datatables.js'); ?>"></script>
    <!-- SELECT 2 -->
    <script src="<?php echo base_url($plugins_dir . '/bootstrap_select/bootstrap-select.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/select2/js/select2.full.min.js'); ?>"></script>

    <!-- TIMEPICKER -->
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/moment.min.js'); ?>"></script>         
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/locales.min.js'); ?>"></script>  

    <!-- LEAFLET -->
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-pip/leaflet-pip.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/map.js'); ?>"></script>

    <!-- AUTOCOMPLETE -->
    <script src="<?php echo base_url($plugins_dir . '/autocomplete/jquery.autocomplete.min.js'); ?>"></script>
  
    <?php
    $controller_atual =  $this->router->class;
    ?>

    <!-- BACKSTRECH -->
    <script src="<?php echo base_url($public_js . '/jquery.backstretch.min.js'); ?>"></script>

    <!-- FIX BODY -->
    <script src="<?php echo base_url($public_js . '/fix_body.js'); ?>"></script>
   
    <!--Arquivo JS -->    
    <script type="text/javascript" src="<?php echo $arq_js; ?>"></script>	
       
    <script type="text/javascript">
            var dir_img = "<?php echo $public_images; ?>", 
                dir_base = "<?php echo base_url(); ?>", 
                dir_site = "<?php echo base_url(); ?>", 
                dir_plugins = "<?php echo $public_plugins; ?>";         
    </script>

    <script type="text/javascript">
        $(document).ready(function ($) {    
                $('#datatable').DataTable({
                    'dom' : '<"top"+<"right"f>>rt<"bottom"p>+<"right"i><"clear">',
                    'language': { 'url': dir_base+'/assets/plugins/datatables/portugues-br.json' },
                    'lengthMenu': [[15, 25, 50,100, -1], [15, 25, 50, 100, 'All']]
                });

                $.backstretch(dir_base+'public/images/fundolilas.png');     
            });
    </script>   
