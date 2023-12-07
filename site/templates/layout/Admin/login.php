<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calligo | Log in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <?= $this->Html->meta('icon', 'favicon.png') ?>
    <?= $this->Html->css([
        'adminlte/adminlte.min',
        'adminlte/fontawesome-free/css/all.min',
        'adminlte/icheck-bootstrap/icheck-bootstrap.min'
    ]) ?>
</head>

<body class="login-page" style="min-height: 496.8px;">

<?= $this->fetch('content') ?>

<?php echo $this->Html->script([
    'adminlte/jquery/jquery.min.js',
    'adminlte/bootstrap/js/bootstrap.bundle.min',
    'adminlte/adminlte.min'
]); ?>

</body>
</html>
