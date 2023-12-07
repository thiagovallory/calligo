<html style="height: auto;" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calligo | Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <?= $this->Html->meta('icon', 'favicon.png') ?>
    <?= $this->Html->css([
        'adminlte/adminlte.min',
        'adminlte/fontawesome-free/css/all.min',
        'adminlte/icheck-bootstrap/icheck-bootstrap.min'
    ]) ?>
</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center" style="height: 0px;">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="" style="display: none;" width="60" height="60">
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cogs"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="<?=$this->Url->build(['controller'=>'Users','action'=>'logout','prefix'=>'Admin']) ?>" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Calligo</span>
        </a>

        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
            <div class="os-resize-observer-host observed">
                <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
            </div>
            <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                <div class="os-resize-observer"></div>
            </div>
            <div class="os-padding">
                <div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid" style="overflow-y: scroll;">
                    <div class="os-content" style="height: 100%; width: 100%;">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="<?=$this->Url->build(['controller'=>'Users','action'=>'index','prefix'=>'Admin']);?>" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="height: 10.8904%; transform: translate(0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar-corner"></div>
        </div>
    </aside>

    <div class="content-wrapper" style="min-height: 91px;">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <?= $this->fetch('content') ?>
            </div>
        </section>

    </div>
    <div id="sidebar-overlay"></div>
</div>

<?php echo $this->Html->script([
    'adminlte/jquery/jquery.min.js',
    'adminlte/bootstrap/js/bootstrap.bundle.min',
    'adminlte/adminlte.min'
]); ?>

</body>
</html>
