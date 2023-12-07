<?php if($hasComponent) { ?>
<div class="box white agenda_box component" cp-name="boxAgenda" data-profile-id="<?= $user->profile->id ?>">
<?php } else { ?>
<div class="box white agenda_box" data-profile-id="<?= $user->profile->id ?>">
<?php } ?>
    <?php if($hasHeader) { ?>
        <h5 class="text-left">Horários disponíveis</h5>
        <br>
    <?php } ?>

    <div class="agenda-month">
        <p class="body1 bold">
            <?php if($hasComponent) { ?>
            <span class="previous_arrow material-icons-outlined">arrow_back_ios</span>
            <?php } ?>

            <span class="agenda_month"><?= $month ?></span> de <span class="agenda_year"><?= $year ?></span>

            <?php if($hasComponent) { ?>
            <span class="next_arrow material-icons-outlined">arrow_back_ios</span>
            <?php } ?>
       	</p>
    </div>
    <div class="agenda-slider_container">
        <div class="agenda_loader">
            <div class="center">
                <div class="lds-heart"><img src="/img/loader_icon.png"></div>
            </div>
        </div>
        <div class="agenda_slider">
            <div class="step-agenda" data-month="<?= $month ?>" data-year="<?= $year ?>">
                <div class="table_header">
                    <div class="row">
                        <?php foreach ($schedule_settings as $key => $schedule_setting) : ?>
                            <div class="col">
                                <p class="agenda_header-title"><?= $week_days[$key] ?></p>
                                <p class="body1 text-center bold"><?= $week[$key] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="table_agenda-days">
                    <div class="row">
                        <?php foreach ($schedule_settings as $key => $schedule_setting) : ?>
                            <div class="col">
                                <ul>
                                    <?php foreach ($schedule_setting as $obj) : ?>
                                        <li class="agenda_input-list <?= $obj['selected'] ? '' : 'available-date' ?>" info-date="<?= $year ?>-<?= date('m') ?>-<?= $week[$key] ?>">
                                            <div class="agenda_input-hour agenda_input-<?= $obj['selected'] ? 'selected' : 'none' ?>" type="text" data-hour="<?= $obj->hour; ?>" placeholder="00:00" data-day="<?= $week[$key] ?>">
                                                <p class="caption"><?= $obj->hour; ?></p></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p class="body1 text-center"><?= $time_zones[$user['profile']['default_time_zone']] ?></p>
</div>


<!-- Modal -->
<div class="modal fade modal_agenda appointment-modal" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Agendar sessão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-profile">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-profile__header">
                                <div class="modal-profile-photo">
                                    <img src="<?= $user->profile->photo; ?>" />
                                </div>
                                <div>
                                    <p class="body1"><?= $user->name; ?></p>
                                    <input type="hidden" class="therapist_id" value="<?= $user->id ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="body1 bold modal_subtitle">Tipo de terapia</p>

                    <?php foreach ($user->costs as $cost) : ?>
                        <div class="form-check">
                            <input class="terapiaRadio form-check-input" value="<?= $cost->modality->id; ?>" <?= ($_userLogged && $_userLogged['role'] == 2 && $cost->modality->id != 6) ? 'disabled' : '' ?> data-price="<?= $cost->value_full; ?>" type="radio" name="tipoTerapiaRadio">
                            <label for="uncheckedRadio" class="form-check-label body1">
                                <?= $cost->modality->name; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <br><br>
                    <p class="body1 bold modal_subtitle">Modo da sessão</p>


                    <?php if ($user->profile->attendance_by_video_call): ?>
                        <div class="form-check">
                            <input class="form-check-input therapy_mode" value="1" type="radio" name="tipoSessaoRadio">
                            <label for="uncheckedRadio" class="form-check-label body1">
                                Vídeo
                            </label>
                        </div>
                    <?php endif; ?>
                    <?php if ($user->profile->attendance_by_phone_call): ?>
                        <div class="form-check">
                            <input class="form-check-input therapy_mode" value="2" type="radio" name="tipoSessaoRadio">
                            <label for="uncheckedRadio" class="form-check-label body1">
                                Áudio
                            </label>
                        </div>
                    <?php endif; ?>

                    <br><br>
                    <p class="body1 bold modal_subtitle">Período</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="dates__wrapper">
                                <div class="modal-agenda_date">
                                    <span class="material-icons-outlined">calendar_today</span>
                                    <span class="modal-agenda_date-text">
                                        <span class="modal-agenda_month"></span> <span class="modal-agenda_day"></span>, <span class="modal-agenda_year"></span>
                                    </span>
                                </div>
                                <div class="modal-agenda_date">
                                    <span class="material-icons-outlined">schedule</span>
                                    <span class="modal-agenda_date-text">
                                        <span class="modal_agenda-date-hour"></span>
                                        <span class="modal-hour-divisor">às</span>
                                        <span class="modal_agenda-last-date-hour"></span>
                                    </span>
                                </div>
                                <div class="modal-agenda_date">
                                    <span class="agenda_label">R$ </span><span class="agenda_price"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="modal-hidden_fullDate">
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">CANCELAR</button>
                <button type="button" class="btn btn-primary" id="solicitar_agendamento" info-date="">CONCLUIR AGENDAMENTO</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal_agenda-sucesso" id="agendar_consulta-sucesso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="h5 text-center">Solicitação enviada com sucesso!</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="body1">
                    Sua solicitação para agendar uma consulta com <?= $user->name; ?> foi enviada com sucesso! Aguarde <?= $user->name; ?> responder a solicitação para realizar o pagamento e garantir seu horário.
                </p>
            </div>
        </div>
    </div>
</div>
