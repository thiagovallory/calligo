<?php use Cake\Routing\Router;?>
<!DOCTYPE html>
<html>
<?php
echo $this->element('head');
?>
<body>
	<script>var _BASE_URL_ = "<?php echo Router::url("/", false);?>";</script>
    <?php echo $this->element('header');?>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <?php echo $this->element('footer');?>
    <?php echo $this->Html->script('vendors');?>
    <?php echo $this->Html->script('main');?>
</body>
</html>
