<?php
/**
 * Created by PhpStorm.
 * User: JoséAndrès
 * Date: 07/06/2016
 * Time: 10:44
 */

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_POST['datos_a_enviar'];
?>