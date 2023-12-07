<main class="main component no-model">
    <div class="container-fluid">
        <div class="row no-gutter wrapper">
            <div class="col-lg-12">
                <div class="container flex-fullcentered">
                    <div class="col-lg-4">
                        <div>
                            <h3>Alterar E-mail</h3>
                            <p class="text-center">Informe o novo e-mail para sua conta</p>
                            <div class="form-wrapper col-md-12">
                                <?= $this->Form->create($user) ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Form->control('current_password', array(
                                            'autocomplete' => 'new-password',
                                            'type'         => 'password',
                                            'label'        => '',
                                            'class'        => 'form-control',
                                            'placeholder'  => 'Sua senha'
                                        )); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Form->control('username', array(
                                            'label'       => '',
                                            'class'       => 'form-control',
                                            'placeholder' => 'Novo E-mail',
                                            'value'       => '',
                                        )); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Form->control('username_confirm', array(
                                            'label'       => '',
                                            'class'       => 'form-control',
                                            'placeholder' => 'Confirmar E-mail',
                                            'value'       => '',
                                        )); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Form->button('Alterar', array(
                                            'class' => 'form-control btn btn-primary',
                                        )); ?>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
