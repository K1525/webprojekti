<?php

// db-init.php

$db = new PDO('mysql:host=mysql.labranet.jamk.fi;dbname=H8718_1;charset=utf8',

              'H8718', 'XdyeRqeh7J7aKPhstPFq2qFXRpA75EvL');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>

