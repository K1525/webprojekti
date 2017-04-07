<?php
// db-init.php
/*$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=H8718_1;charset=utf8',
              'H8718', 'XdyeRqeh7J7aKPhstPFq2qFXRpA75EvL');*/
$db = new PDO('mysql:host=127.0.0.1;dbname=BlackBanana;charset=utf8',
'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>