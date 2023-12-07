<main class="main component no-model nobg_sidbr">
    <div class="container-fluid">
        <div class="row no-gutter wrapper">
            <div class="col-lg-12">
                <div class="container flex-fullcentered">
                    <div class="col-lg-4">
                        <div class="component" cp-name="pwdView">
                            <h3>Alterar Senha</h3>
                            <p class="text-center">Informe a nova senha para sua conta</p>
                            <div class="form-wrapper col-md-12">
                                <?= $this->Form->create($user) ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pwd-wrapper">
                                            <?= $this->Form->control('current_password', array(
                                                'autocomplete' => 'new-password',
                                                'label'        => '',
                                                'class'        => 'form-control password-field',
                                                'type'         => 'password',
                                                'placeholder'  => 'Senha atual'
                                            )); ?>
                                            <span class="icon-on material-icons-outlined">visibility</span>
                                            <span class="icon-off material-icons-outlined">visibility_off</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pwd-wrapper">
                                            <?= $this->Form->control('password', array(
                                                'autocomplete' => 'new-password',
                                                'value'        => '',
                                                'label'        => '',
                                                'class'        => 'form-control password-field',
                                                'type'         => 'password',
                                                'placeholder'  => 'Senha'
                                            )); ?>
                                            <span class="icon-on material-icons-outlined">visibility</span>
                                            <span class="icon-off material-icons-outlined">visibility_off</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pwd-wrapper">
                                            <?= $this->Form->control('password_confirm', array(
                                                'label'       => '',
                                                'class'       => 'form-control password-field',
                                                'type'        => 'password',
                                                'placeholder' => 'Confirmar Senha'
                                            )); ?>
                                            <span class="icon-on material-icons-outlined">visibility</span>
                                            <span class="icon-off material-icons-outlined">visibility_off</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Form->button('Alterar', array(
                                            'class' => 'form-control btn btn-primary text-center',
                                        )); ?>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                                <br>
                                <?= $this->Form->postLink('Esqueceu a senha?', ['controller' => 'Account', 'action' => 'forgotPassword'], ['class' => 'body1 text-center']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
