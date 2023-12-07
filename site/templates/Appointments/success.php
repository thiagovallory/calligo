<?php use Cake\Core\Configure;?>
<main class="main">
    <div id="profile-page" class="payment-page content">
    	<div class="profile-content container flex-fullcentered component">
			<div class="row">
                <div class="form-header">
                    <p class="body1 text-center bold">
                        <span class="circle"><span class="material-icons-outlined text__primary50">check</span></span> Pagamento
                        <span class="material-icons-outlined">navigate_next</span>
                        <span class="text__primary50"><span class="circle">3</span> Confirmação</span>
                    </p>
                </div>
                <div class="col-12">
                    <div class="box white text-center">
                    	<p class="h4 text-center">Agendamento realizado com sucesso!</p>
                    	<p class="text-center">Número do pedido: <?= $id ?></p>
                    	<br>
                    	<p class="text-center">Agora é só esperar o dia da sua consulta chegar!</p>
                    	<br>
                    	<a href="<?= $this->Url->build(['controller'=>'Dashboard','action'=>'index']);?>" class="btn btn-bold btn-primary" tabindex="0">VOLTAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
