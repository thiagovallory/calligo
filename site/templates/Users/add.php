<?php
$role   = ($this->request->getQuery('role')) ? $this->request->getQuery('role') : 2;
$status = ($this->request->getQuery('status')) ? $this->request->getQuery('status') : null;

if ($status == 'success') : ?>
    <main id="accountType" class="main">
        <div class="container flex-fullcentered">
            <div class="row">
                <div class="col">
                    <img id="successImage" class="desktop" src="/img/ilustra-registerSuccess.png" alt="">
                    <h3>Você deu o primeiro passo<br>na sua transformação!</h3>
                    <p class="subtitle2">Confira a mensagem que enviamos para <?= $this->request->getQuery('email') ?>
                        ative sua conta e <br class="desktop">ingresse em um ambiente de evolução contínua.</p>
                </div>
            </div>
            <div class="row controls">
                <div class="col">
                    <a href="/" class="btn btn-bold btn-primary">Início</a>
                    <button class="btn btn-bold btn-outline-primary" data-email="<?= $this->request->getQuery('email') ?>" id="btnResendEmail">
                        Reenviar Link
                    </button>
                    <br class="mobile">
                    <img id="successImage" class="mobile" src="/img/ilustra-registerSuccess.png" alt="">
                </div>
            </div>
        </div>
    </main>
<?php else: ?>
    <main id="login" class="component main" cp-name="login">
        <div class="container-fluid">
            <div class="row no-gutter wrapper">
                <div class="col-lg-6">
                    <div class="container flex-fullcentered offset-header">
                        <div class="col-md-8">
                            <div id="loginForm">
                                <div class="form-wrapper col-md-11">
                                    <h3>Bem-vindo(a)!<br>Vamos evoluir juntos?</h3>
                                    <br class="mobile">
                                    <p>Encontre um Psicólogo.<br> Encontre aqui o Psicólogo que pode ajudar a
                                        transformar sua vida.</p>
                                    <br class="mobile">
                                    <?php
                                    echo $this->Form->create($user);
                                    echo $this->Form->control('role', ['type' => 'hidden', 'value' => $role]);
                                    echo $this->Form->control('name', ['placeholder' => 'Nome Completo', 'label' => false, 'class' => 'form-control']);
                                    echo $this->Form->control('profile.telephone_number', ['placeholder' => 'Telefone', 'label' => false, 'class' => 'mask_phone form-control']);
                                    echo $this->Form->control('username', ['type' => 'email', 'placeholder' => 'E-mail', 'label' => false, 'class' => 'form-control']);
                                    ?>

                                    <?php
                                    if ($role == 2) {
                                        ?>
                                        <div class="crp-wrapper">
                                            <?php
                                            echo $this->Form->control('profile.crp', ['placeholder' => 'CRP', 'label' => false, 'class' => 'form-control']);
                                            echo $this->Form->control('profile.crp_origin', ['class' => 'form-control form-select', 'label' => 'Origem do CRP', 'options' => $crp_origins, 'empty' => ' ']);
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="pwd-wrapper">
                                        <?= $this->Form->control('password', ['placeholder' => 'Senha', 'label' => false, 'class' => 'form-control password-field']); ?>
                                        <span class="icon-on material-icons-outlined">visibility</span>
                                        <span class="icon-off material-icons-outlined">visibility_off</span>
                                    </div>
                                    <div class="pwd-wrapper">
                                        <?= $this->Form->control('password_confirm', ['placeholder' => 'Confirmar senha', 'type' => 'password', 'label' => false, 'class' => 'form-control password-field']); ?>
                                        <span class="icon-on material-icons-outlined">visibility</span>
                                        <span class="icon-off material-icons-outlined">visibility_off</span>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="accept_terms" value="1" required="required">
                                        <label class="form-check-label" for="accept_terms">Li e concordo com os
                                            <a href="<?php if ($role == 2): ?>/docs/Termo_de_Uso_PSICOLOGO.docx<?php else: ?>/docs/Termo_de_Uso_PACIENTE.docx<?php endif; ?>">Termos
                                                de Uso</a> e <a href="javascript:;">Políticas de
                                                Privacidade.</a></label>
                                    </div>
                                    <?php
                                    if ($role == 2) { ?>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="not_empoloyee" value="1" required="required">
                                            <label class="form-check-label" for="not_empoloyee">Entendo que não serei um
                                                funcionário da Calligo, mas um fornecedor independente que presta
                                                serviços através da plataforma.</label>
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="accept_contact" value="1" required="required">
                                        <label class="form-check-label" for="accept_contact">Estou ciente de que ao
                                            enviar este formulário, autorizo a Calligo a entrar em contato por e-mail ou
                                            ser contatado(a) pelo número de telefone fornecido.</a></label>
                                    </div>
                                    <br>
                                    <?= $this->Form->button('Cadastrar', array(
                                        'class' => 'form-control btn btn-bold btn-primary',
                                    )); ?>
                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="mobile">
                <div class="col-lg-6 login-slider desktop desktopFlex">
                    <div class="slider">
                        <div class="slide-item">
                            <img src="/img/ilustra-login.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 mobile">
                    <br class="mobile">
                    <img src="/img/ilustra-login-mobile.png" style="width: 100%;">
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>
