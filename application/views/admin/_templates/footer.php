<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

</div>

<!-- BASICO ADMINLTE -->
<script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
<script src="<?php echo base_url($frameworks_dir . '/domprojects/js/dp.min.js'); ?>"></script>
<script src="<?php echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script>


<!-- EXCLUIR -->
<script src="<?php echo base_url('public/javascript/admin/funcoes/excluir.js'); ?>"></script>

<!-- ICHECK e LIGHT BOX -->
<script src="<?php echo base_url($plugins_dir . '/icheck/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url($plugins_dir . '/lightbox2/js/lightbox.min.js'); ?>"></script>
<script src="<?php echo base_url($plugins_dir . '/jquery-mask/jquery.mask.min.js'); ?>"></script>

<!--select 2---->
<script src="<?php echo base_url($plugins_dir . '/select2/js/select2.full.min.js'); ?>"></script>

<!-- DATATABLES -->
<script src="<?php echo base_url($plugins_dir . '/datatables/datatables.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            'language': {
                'url': '../assets/plugins/datatables/portugues-br.json'
            },
            'paging': true,
            'ordering': true,
            'info': true,
            'searching': true,
            'autoWidth': true,
            'lengthMenu': [[15, 25, 50,100, -1], [15, 25, 50, 100, 'All']]
        });
    });
</script>
<!-- BOOTSTRAP FILESTYLE UPLOAD -->
<script src="<?php echo base_url($plugins_dir . '/bootstrap-filestyle/bootstrap-filestyle.min.js'); ?>"></script>

<?php
$methods_array = array('create', 'edit', 'view', 'index');
?>

<!-- MOBILE -->
<?php if ($mobile == TRUE) : ?>
    <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
<?php endif; ?>

<!-- ANIMSITION TRANSITIONS -->
<?php if ($admin_prefs['transition_page'] == TRUE) : ?>
    <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
<?php endif; ?>

<!-- PASSWORD STRENGTH -->
<?php if ($this->router->fetch_class() == 'users' && (in_array($this->router->fetch_method(), $methods_array))) : ?>
    <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
<?php endif; ?>

<!-- COLORPICKER -->
<?php
$colorpicker_array = array('groups');
$include_colorpicker = isset($includes['colorpicker']) ? $includes['colorpicker'] : array();
?>

<?php if (
    (in_array($this->router->fetch_class(), $colorpicker_array) || in_array($this->router->fetch_class(), $include_colorpicker))
    &&
    (in_array($this->router->fetch_method(), $methods_array))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/tinycolor/tinycolor.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.js'); ?>"></script>

<?php endif; ?>

<!-- SELECT2 e SELECT-BOOTSTRAP -->
<?php
$select_bt_array = array('menuitens');
$include_select2 = isset($includes['select2']) ? $includes['select2'] : array();
?>

<?php if (
    (in_array($this->router->fetch_class(), $select_bt_array) || in_array($this->router->fetch_class(), $include_select2))
    &&
    (in_array($this->router->fetch_method(), $methods_array))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/bootstrap_select/bootstrap-select.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/select2/js/select2.full.min.js'); ?>"></script>

<?php endif; ?>

<?php
$datepicker_array = array('');
$include_datepicker = isset($includes['datepicker']) ? $includes['datepicker'] : array();
?>

<!-- DATETIMEPICKER -->
<?php if (
    (in_array($this->router->fetch_class(), $datepicker_array) || in_array($this->router->fetch_class(), $include_datepicker))
    &&
    (in_array($this->router->fetch_method(), $methods_array))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/locales.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/javascript/admin/users/user_timepicker.js'); ?>"></script>

<?php endif; ?>

<!--  CYCLE2 -->
<?php
$cycle2_array = array('');
$include_cycle2 = isset($includes['cycle2']) ? $includes['cycle2'] : array();

?>

<?php if (
    (in_array($this->router->fetch_class(), $cycle2_array) || in_array($this->router->fetch_class(), $include_cycle2))
    &&
    (in_array($this->router->fetch_method(), array('index', 'view')))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.carousel.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.center.min.js'); ?>"></script>

<?php endif; ?>

<?php
$leaflet_array = array('');
$include_leaflet = isset($includes['leaflet']) ? $includes['leaflet'] : array();
?>

<!-- LEAFLET -->
<?php if (
    (in_array($this->router->fetch_class(), $leaflet_array) || in_array($this->router->fetch_class(), $include_leaflet))
    &&
    (in_array($this->router->fetch_method(), $methods_array))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/map.js'); ?>"></script>

<?php endif; ?>

<!-- CHARTJS -->
<?php
$chartjs_array = array('');
$include_chartjs = isset($includes['chartjs']) ? $includes['chartjs'] : array();
?>

<?php if (
    (in_array($this->router->fetch_class(), $chartjs_array) || in_array($this->router->fetch_class(), $include_chartjs))
    &&
    (in_array($this->router->fetch_method(), $methods_array))
) :
?>

    <script src="<?php echo base_url($plugins_dir . '/chartjs/Chart.min.js'); ?>"></script>

<?php endif; ?>

<!-- FIX JS -->
<script src="<?php echo base_url('public/javascript/fix_body.js'); ?>"></script>

<?php
//JS do Controller (Só adiciona se achar)
$js = FCPATH . "public/javascript/admin/controllers/" . $this->router->fetch_class() . '.js';
if (file_exists($js)) :
?>

    <script src="<?php echo base_url('public/javascript/admin/controllers/' . $this->router->fetch_class() . '.js'); ?>"></script>
<?php endif; ?>

</body>

</html>