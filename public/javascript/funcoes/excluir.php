
<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>


<?php
    $lixo = R::load("agenda", $id);
    R::trash($lixo);


    redirect('admin/calendar', 'refresh');

?>