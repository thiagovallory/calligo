<?php use Cake\Utility\Hash; ?>

<div id="profile-page" class="main content offset-header">
    <div class="profile-header">
        <div class="profile-header-container">
            <div class="row">
                <div class="col-3 justify-content-start">
                    <div class="user-photo"><img src="<?php echo $user['profile']['photo']; ?>" /></div>
                </div>
                <div class="col-7 align-items-start">
                    <div class="profile-name-container">
                        <p class="profile-name"><?= $user['name']; ?></p>
                        <p class="subtitle2 text-left text__white">CRP <?= $user['profile']['crp'] ?></p>
                        <?php if ($user['profile']['video_url']): ?>
                            <img src="/img/youtube.png" width="24px" height="24px" /><a class="m-2 link text-white" style="text-decoration: none" href="<?= $user['profile']['video_url'] ?>" target="_blank">Venha me conhecer!</a>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4 g-0">
                                    <div class="icon-container"><?= $this->Html->image('icon-experiencia.png'); ?></div>
                                </div>
                                <div class="col-8">
                                    <p class="body1 text__gray30 cat-title">Experiencia</p>
                                    <p class="subtitle1 text__white bold"><?= $user['profile']['time_work_experience'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4 g-0">
                                    <div class="icon-container"><?= $this->Html->image('icon-consultas.png'); ?></div>
                                </div>
                                <div class="col-8">
                                    <p class="body1 text__gray30 cat-title">Consultas</p>
                                    <p class="subtitle1 text__white bold"><?= $appointments ?></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4 g-0">
                                    <div class="icon-container"><?= $this->Html->image('icon-clientes.png'); ?></div>
                                </div>
                                <div class="col-8">
                                    <p class="body1 text__gray30 cat-title">Clientes</p>
                                    <p class="subtitle1 text__white bold"><?= $clients ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">

                        </div>
                    </div>
                </div>
                <!--
                    <div class="col-2">
                        <button class="btn btn-primary chat_button"><?= $this->Html->image('icon-chat.png'); ?>Conversar
                        </button>
                        <a href="javascript:;"><?= $this->Html->image('icon-share.png'); ?></a>
                    </div>
                -->
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="row">
            <div class="col-8">
                <div class="box white">
                    <p class="profile-box-title">Sobre</p>

                    <br>
                    <div class="row">
                        <div class="col-3">
                            <p class="body1 bold">Experiencia</p>
                        </div>
                        <div class="col-3">
                            <p class="body1"><?= $user['profile']['time_work_experience'] ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="body1 bold">Atendimento</p>
                        </div>
                        <div class="col-3">
                            <p class="body1"><?= $user['profile']['attendance_by_phone_call'] ? ($user['profile']['attendance_by_video_call'] ? 'Áudio e Vídeo' : 'Áudio') : ($user['profile']['attendance_by_video_call'] ? 'Video' : ''); ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="body1 bold">Faixa Etária</p>
                        </div>
                        <div class="col-3">
                            <p class="body1">
                                <?= implode(' ', Hash::extract($user['ages'], '{n}.name')) ?>
                            </p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="body1 bold">Idiomas</p>
                        </div>
                        <div class="col-3">
                            <p class="body1">
                                <?= implode('; ', Hash::extract($user['langs'], '{n}.name')) ?>
                            </p>
                        </div>
                        <div class="col"></div>
                    </div>

                    <?php if ($user['profile']['video_url']): ?>
                        <div class="row">
                            <div class="col-3">
                                <p class="body1 bold">Vídeo sobre o terapeuta</p>
                            </div>
                            <div class="col-3">
                                <a href="<?= $user['profile']['video_url'] ?>" class="body1">Clique para ver o vídeo</a>
                            </div>
                            <div class="col"></div>
                        </div>
                    <?php endif; ?>

                    <p class="body1"><?= $user['profile']['description'] ?></p>
                </div>
                <div class="box white">
                    <p class="profile-box-title">Especialidades</p>
                    <div class="box__tag-wrapper">
                        <?php foreach ($user['specialties'] as $speciality) {
                            echo '<div class="box-tag"><p class="body1">' . $speciality['name'] . '</p></div>';
                        } ?>
                    </div>
                    <br><br><br>
                    <p class="profile-box-title">Abordagens</p>

                    <div class="box__tag-wrapper">
                        <?php foreach ($user['therapies'] as $therapy) {
                            echo '<div class="box-tag"><p class="body1">' . $therapy['name'] . '</p></div>';
                        } ?>
                    </div>
                </div>
                <div class="box white">
                    <p class="profile-box-title">Formação Acadêmica</p>
                    <ul>
                        <?php foreach ($user['academic_backgrounds'] as $academic_background) { ?>
                            <li class="attc_academic-list">
                                <p class="body1 bold"><?= $academic_background['period_start']->format('Y') . '-' . $academic_background['period_end']->format('Y'); ?></p>
                                <p class='body1'><?= $academic_background_types[$academic_background['type']] . ' em ' . $academic_background['class_name']; ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <div class="box white">
                    <p class="profile-box-title">Valores das Sessões</p>
                    <?php foreach ($user['costs'] as $cost) { ?>
                        <div class="row align-middle">
                            <div class="col-6 my-auto">
                                <p class="body1 bold"><?= $cost['modality']['name']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="value-label"><?= 'R$ ' . $cost['value_full'] . ''; ?></p>
                                <p class="body1 text__gray50 text-right"><?= 'Sessão de ' . $user['profile']['session_duration'] . 'min'; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php echo $this->element('agenda/agenda-box', ['hasHeader' => true, 'hasComponent' => true]); ?>
            </div>
        </div>
    </div>

    <div class="profile_comments component" cp-name="comments">
        <h5>Veja o que os clientes estão falando</h5>
        <br>
        <div class="comments-slider">
            <!-- TODO: mudar o limit para a consulta -->
            <?php foreach ($user['reviews_received'] as $key => $review): ?>
                <div class="comment-container">
                    <p class="body1 bold"><?= $review['title']; ?></p>
                    <p class="body1 comment">“<?= $review['description']; ?>”</p>
                    <p class="body1 bold"><?= $review['reviewer']['abbrv']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
