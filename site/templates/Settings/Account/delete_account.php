<main class="main component no-model delete_account">
    <div class="container-fluid">
        <div class="row no-gutter wrapper">
            <div class="col-lg-12">
                <div class="container flex-fullcentered">
                    <div class="col-lg-4">
                        <div class="delete_account_container">
                            <h3>Excluir conta</h3>
                            <p class="text-center">Olá, <?= $_userLogged['name'];?>. Que pena que você quer excluir sua conta.
                                Se você desja apenas dar um tempo, você pode desativar a sua conta e assim manter todos os teus dados.</p>

                            <p class="bold">Conta pra gente, por que você está excluindo sua conta?</p>
                            <div class="form-wrapper col-md-12">
                                <div class="row">
                                    <?= $this->Form->create($user) ?>
                                    <div class="col-md-12">
                                        <div class="pwd-wrapper">
                                            <?= $this->Form->control('reason_id', array(
                                                'label'   => '',
                                                'class'   => 'form-control form-select',
                                                'options' => $reasons,
                                                'empty'   => 'Categorias'
                                            )); ?>
                                            <!--<p>Para excluir sua conta, você não pode ter nenhuma pendência. Veja abaixo as sua pendências:</p>
                                            <uL>
                                                <li>Você possui consultas marcadas, cancele ou realize as sessões.</li>
                                                <li>Você precisa encerrar a terapia com o psicólogo que estás consultando.</li>
                                                <li>Você tem saldo devedor.</li>
                                            </uL>
                                            -->
                                            <p class="bold">Para continuar insira sua senha:</p>
                                            <?= $this->Form->control('current_password', array(
                                                'autocomplete' => 'new-password',
                                                'label'        => '',
                                                'class'        => 'form-control password-field',
                                                'type'         => 'password',
                                                'placeholder'  => 'Sua senha'
                                            )); ?>
                                            <p>Ao clicar no botão abaixo dentro de um período de 7 dias todos os seu dados serão removidos, e não poderão ser recuperados. Caso decida desistir de excluir sua conta dentro desse período, basta logar novamente para recuperá-la.</p>
                                            <?= $this->Form->button('Deletar conta permanentemente', array(
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
    </div>
</main>
