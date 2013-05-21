<?php
require_once 'includes/db.php';
$db = new db();
$marcas = $db->dame_query("select id, nombre from marcas");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="chrome=1"/>
        <title>Todas las marcas :: mercadomotor.com.ve </title>
        <link href="css/my_layout.css" rel="stylesheet" type="text/css" />
        <style media="all" type="text/css">
            body{
                background: white;
            }
        </style>
    </head>
    <body>
        <h2>Todas las marcas</h2>
        <?php if ($marcas['suceed'] && count($marcas['data'] > 0)): ?>
            <?php foreach ($marcas['data'] as $marca) : ?>
                <a target="_parent" title="<?php echo $marca['nombre']; ?>" class="c25l" href="<?php echo ROOT ?>/autos/<?php echo $marca['nombre']; ?>#modelos"><?php echo ucfirst($marca['nombre']); ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>
