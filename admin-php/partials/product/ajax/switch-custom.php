<?php

if ( isset($_GET['type']) && $_GET['type'] == 'custom' ) {
 $db->bind('id', $_GET['id']);
 $db->bind('custom', $_GET['v']);
 $switchCustom = $db->row(" UPDATE product SET custom = :custom WHERE productid = :id ");

 echo $switchCustom;
};

?>