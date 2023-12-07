<?php use Cake\Routing\Router;?>
<!DOCTYPE html>
<html>
<?php echo $this->element('head');?>
<body>
	<div class="loader">
		<div class="center">
			<div class="lds-heart"><img src="/img/loader_icon.png"></div>
		</div>
	</div>
	<script>var _BASE_URL_ = "<?php echo Router::url("/", false);?>";</script>
    <?php echo $this->element('header');?>

    <?= $this->Flash->render() ?>
	<main class="main component area-<?= $this->request->getParam('controller'); ?>" cp-name="sidebar">
		<div class="sidebar_mod container-fluid sidebar__wrapper" sidebar-type="desktop">
			<div class="sidebar_mod-container mobile">
				<?php echo $this->element('sidebar/'.$sidebar);?>
			</div>
			<div class="row no-gutter wrapper">
				<div class="col-lg-2 sidebar__navigation fixedPos desktop desktopFlex">
					<?php echo $this->element('sidebar/'.$sidebar);?>
				</div>

				<div class="col-lg-2 sidebar__navigation desktop desktopFlex">
					<div class="sidebar_help">
						<img src="/img/Frame.png">
						<p class="body1 text-white">
							Qualquer dúvida estamos<br> aqui para te ajudar.
						</p>
			            <a class="btn btn-primary" href="<?= $this->Url->build(['controller'=>'Helps','action'=>'index', 'prefix' => false]);?>">Ajuda</a>
			        </div>

			        <a class="help-button" href="/help"><img src="/img/ajuda.png"></a>
				</div>

				<div class="col-lg-10 sidebar-content">
					<div class="sidebar-content__wrapper">
						<div class="container dashboard-content">
							<?= $this->fetch('content') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>    
    <?php echo $this->Html->script('vendors');?>
    <?php echo $this->Html->script('main');?>
</body>
</html>