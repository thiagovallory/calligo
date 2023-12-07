<div class="container dashboard-content component" cp-name="setNotifications">
    <div class="content-header">
        <h4>Notificações</h4>
    </div>
    <div class="content-body">
        <div class="form-wrapper box col-12">
            <div class="row">
                <div class="col-lg-10">
                    <h5>Atualizações da Calligo</h5>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <h5>Email</h5>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <h5>SMS</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <strong>Novidades da Calligo</strong>
                    <p>Novas funcionalidades e atualizações</p>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.email_update_news', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.sms_update_news', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <strong>Atualizações dos termos</strong>
                    <p>Atualizações dos termos de uso e de privacidade</p>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.email_update_terms', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.sms_update_terms', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <h5>Consultório</h5>
                </div>
            </div>

                <div class="row">
                    <div class="col-lg-10">
                        <strong>Consultas</strong>
                        <p>Novas consultas, consultas remarcadas e consultas canceladas</p>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.email_clinic_schedule', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.sms_clinic_schedule', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <strong>Terapia de Alcance</strong>
                        <p>Novas solicitações de terapia de alcance</p>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.email_clinic_therapy', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.sms_clinic_therapy', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <strong>Mensagens</strong>
                        <p>Novas mensagens de clientes</p>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.email_clinic_messages', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-lg-1 d-flex justify-content-center">
                        <?= $this->Form->create($user); ?>
                        <?= $this->Form->checkbox('notification.sms_clinic_messages', ['class' => 'form-check-input']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

            <div class="row">
                <div class="col-lg-10">
                    <h5>Aprendizado</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <strong>Novidades</strong>
                    <p>Novos produtos adicionados</p>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.email_learn_news', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.sms_learn_news', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <strong>Ofertas</strong>
                    <p>Ofertas de produtos</p>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.email_learn_offers', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-lg-1 d-flex justify-content-center">
                    <?= $this->Form->create($user); ?>
                    <?= $this->Form->checkbox('notification.sms_learn_offers', ['class' => 'form-check-input']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
