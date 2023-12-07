<?php 
    
    if ($success) :

?>
<main id="accountType" class="main">
    <div class="container flex-fullcentered">
        <div class="row">
            <div class="col">
                <img id="successImage" src="/img/ilustra-registerSuccess.png" alt="">
                <h3>Conta ativada com sucesso</h3>
            </div>
        </div>
        <div class="row controls">
            <div class="col">
                <?php
                    echo $this->Html->link('Entrar',
                            ['controller' => 'Users', 'action' => 'login'],
                            ['class'=>'btn btn-bold btn-primary']
                    );
                ?>
            </div>
        </div>
    </div>
</main>
<?php

    else :
?>    	
<main id="accountType" class="main">
    <div class="container flex-fullcentered">
        <div class="row">
            <div class="col">
                <img id="successImage" src="/img/ilustra-registerSuccess.png" alt="">
                <h3>Ocorreu um problema na sua ativação</h3>
                <p class="subtitle2">Por favor, tente novamente</p>
            </div>
        </div>
        <div class="row controls">
            <div class="col">
                <a href="/" class="btn btn-bold btn-primary">Início</a>                                              
                <button class="btn btn-bold btn-outline-primary" data-email="'<?= $this->request->getQuery('email') ?>" id="btnResendEmail">Reenviar Link</button>                
            </div>
        </div>
    </div>
</main>
<?php
    endif;
?>