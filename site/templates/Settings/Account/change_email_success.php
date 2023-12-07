<main class="main component no-model">
    <div class="container-fluid">
        <div class="row no-gutter wrapper">
            <div class="col-lg-12">
                <div class="container flex-fullcentered">
                    <div class="col-lg-4">
                        <div>
                            <h3>E-mail alterado com sucesso!</h3>
                            <p class="text-center">Seu e-mail foi alterado com sucesso, agora você pode voltar para sua conta!</p>
                            <div class="form-wrapper col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pwd-wrapper">
                                            <?= $this->Html->link('Voltar para Home', ['controller' => 'Account', 'action' => 'index'], ['class' => 'btn btn-primary btn-bold']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
