<div id="help-search" class="component offset-header" cp-name="helpSearch">
    <section class="searchForm container-fluid bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <div class="row">
                        <div class="col">
                            <h1>Central de Ajuda</h1>
                            <p style="display: none" class="subtitle1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel nibh pulvinar, fermentum ligula eget, lobortis metus.</p>
                        </div>
                    </div>
                    <div class="row form">
                        <div class="col-12 col-sm-10">
                            <div class="form-outline">
                                <input id="help_search-input" class="form-control" type="text" placeholder="Digite a sua dúvida" />
                                <span class="material-icons-outlined">search</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <a href="javascript:;" id="help_search-trggr" class="btn btn-outline-secondary w-100 bg-white btn-bold">Procurar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="accordion">
        <div class="container-categories">
            <div style="display: none" class="row row_mobile-width">
                <?php foreach ($helps as $keyS => $sub) : ?>
                    <?php if($keyS == 0) { ?>
                        <div class="accordion_categories col m-2 m-sm-3 active" data-category="<?= $sub['subject_help']['id']; ?>">
                    <?php } else { ?>
                        <div class="accordion_categories col m-2 m-sm-3" data-category="<?= $sub['subject_help']['id']; ?>">
                    <?php } ?>
                            <div class="accordion_categories-content">
                                <span>
                                    <img class="icon-inactive" src="/img/help-<?= $sub['subject_help']['id']; ?>.png">
                                    <img class="icon-active" src="/img/help-<?= $sub['subject_help']['id']; ?>-active.png">
                                </span>
                                <p class="h5"><?= $sub['subject_help']['name']; ?></p>
                            </div>
                        </div>

                <?php endforeach; ?>
            </div>
        </div>
        <br class="mobile">
        <div class="container help_list">
            <?php foreach ($helps as $keyS => $sub) : ?>
                <?php if($keyS == 0) { ?>
                    <ul class="help_accordion_category active" data-category="<?= $sub['subject_help']['id']; ?>">
                <?php } else { ?>
                    <ul class="help_accordion_category" data-category="<?= $sub['subject_help']['id']; ?>">
                <?php } ?>
                    <p class="h3">
                        <?= $sub['subject_help']['name']; ?>
                    </p>
                    <?php foreach ($sub['helps'] as $keyH => $help) : ?>
                        <li class="accordion_list" id="accordion-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>" aria-expanded="false">
                                    <?= $help['name']; ?>
                                </button>
                                </h2>
                                <div id="collapse-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>" data-bs-parent="#accordion-<?= $sub['subject_help']['id']; ?>-<?= $help['id']; ?>">
                                    <div class="accordion-body">
                                        <?= $help['description']; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ajuda-contato">
        <div class="row">
            <div class="col-12 col-sm-6 ajc-form-container">
                <img class="ajuda-contato-bg desktop" src="/img/ajuda-contato-bg.png">

                <div class="ajc-content">
                    <p class="h1">Como podemos <br class="mobile">te ajudar?</p>
                    <p class="subtitle1">Alguma dúvida ou sugestão? <br class="mobile">Fale Conosco! <br>Em até 48h alguém da nossa equipe irá entrar em contato com você.</p>
                </div>
                <div class="ajc-info">
                    <ul>
                        <li>
                            <img src="/img/email-icon.png">
                            <span class="body1">contato@calligo.com</span>
                        </li>
                        <!--<li>
                            <img src="/img/phone-icon.png">
                            <span class="body1">(00) 00000-0000</span>
                        </li>-->
                        <li>
                            <a target="_blank" href="https://www.instagram.com/calligobr/">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                    <path d="M15.005 7.29749C10.7512 7.29749 7.3075 10.745 7.3075 14.995C7.3075 19.2487 10.755 22.6925 15.005 22.6925C19.2587 22.6925 22.7025 19.245 22.7025 14.995C22.7025 10.7412 19.255 7.29749 15.005 7.29749ZM15.005 19.9912C12.2437 19.9912 10.0087 17.755 10.0087 14.995C10.0087 12.235 12.245 9.99874 15.005 9.99874C17.765 9.99874 20.0012 12.235 20.0012 14.995C20.0025 17.755 17.7662 19.9912 15.005 19.9912Z" fill="#5C02FF"></path>
                                    <path d="M21.1843 0.0969189C18.4243 -0.0318311 11.5881 -0.0255811 8.82556 0.0969189C6.39806 0.210669 4.25681 0.796919 2.53056 2.52317C-0.354443 5.40817 0.0143075 9.29567 0.0143075 14.9969C0.0143075 20.8319 -0.310692 24.6294 2.53056 27.4707C5.42681 30.3657 9.37056 29.9869 15.0043 29.9869C20.7843 29.9869 22.7793 29.9907 24.8231 29.1994C27.6018 28.1207 29.6993 25.6369 29.9043 21.1757C30.0343 18.4144 30.0268 11.5794 29.9043 8.81692C29.6568 3.55067 26.8306 0.356919 21.1843 0.0969189ZM25.5531 25.5619C23.6618 27.4532 21.0381 27.2844 14.9681 27.2844C8.71806 27.2844 6.21181 27.3769 4.38306 25.5432C2.27681 23.4469 2.65806 20.0807 2.65806 14.9769C2.65806 8.07067 1.94931 3.09692 8.88056 2.74192C10.4731 2.68567 10.9418 2.66692 14.9506 2.66692L15.0068 2.70442C21.6681 2.70442 26.8943 2.00692 27.2081 8.93692C27.2793 10.5182 27.2956 10.9932 27.2956 14.9957C27.2943 21.1732 27.4118 23.6944 25.5531 25.5619Z" fill="#5C02FF"></path>
                                    <path d="M23.0075 8.79257C24.0009 8.79257 24.8062 7.98724 24.8062 6.99382C24.8062 6.0004 24.0009 5.19507 23.0075 5.19507C22.0141 5.19507 21.2087 6.0004 21.2087 6.99382C21.2087 7.98724 22.0141 8.79257 23.0075 8.79257Z" fill="#5C02FF"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="30" height="30" fill="white"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </a>

                            <a target="_blank" href="https://www.facebook.com/calligobr">
                                <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                    <path d="M4.25 30H15.5V19.6875H11.75V15H15.5V11.25C15.5 8.1425 18.0175 5.625 21.125 5.625H24.875V10.3125H23C21.965 10.3125 21.125 10.215 21.125 11.25V15H25.8125L23.9375 19.6875H21.125V30H26.75C28.8175 30 30.5 28.3175 30.5 26.25V3.75C30.5 1.68125 28.8175 0 26.75 0H4.25C2.18125 0 0.5 1.68125 0.5 3.75V26.25C0.5 28.3175 2.18125 30 4.25 30Z" fill="#5C02FF"></path>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="30" height="30" fill="white" transform="translate(0.5)"></rect>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-6 ajc-form-container align-middle">
                <div class="ajc-form-content">
                    <div class="form-wrapper">
                        <?= $this->Form->create($helpQuestion) ?>
                            <?php
                                echo $this->Form->control('name', ['placeholder'=>'Nome Completo', 'label' => false, 'class' => 'form-control']);
                                echo $this->Form->control('email', ['placeholder'=>'E-mail', 'label' => false, 'class' => 'form-control']);
                                echo $this->Form->control('telephone', ['placeholder'=>'Telefone', 'label' => false, 'class' => 'form-control']);
                                echo $this->Form->control('message', ['placeholder'=>'Escreva sua mensagem', 'label' => false, 'class' => 'form-control']);
                            ?>
                        <p class="caption">Estou ciente de que ao enviar este formulário, autorizo a Calligo a entrar em contato por e-mail ou ser contatado(a) pelo número de telefone fornecido.</p>
                        <?= $this->Form->button(__('Enviar Mensagem'), ['class' => 'btn btn-primary text-center']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<div class="modal fade modal_confirmacao-newsletter" id="modal_confirmacao-newsletter" tabindex="-1" aria-labelledby="modal_confirmacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="h5 text-center">Mensagem enviada com sucesso!</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="body1">
                </p>
            </div>
        </div>
    </div>
</div>