<div class="modal fade modal_agenda appointment-modal" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Agendar sessão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body component" cp-name="inputDate">
                <div class="modal-profile">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-profile__header">
                                <div class="modal-profile-photo">
                                    <img src="<?= $therapist->therapist->profile->photo; ?>" />
                                </div>
                                <div>
                                    <p class="body1"><?= $therapist->therapist->name; ?></p>
                                    <input type="hidden" class="therapist_id" value="<?= $therapist->therapist->id ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="body1 bold modal_subtitle">Tipo de terapia</p>

                    <?php foreach ($therapist->therapist->costs as $cost) : ?>
                        <div class="form-check">
                            <input class="terapiaRadio form-check-input" value="<?= $cost->modality->id; ?>" <?= ($_userLogged && $_userLogged['role'] == 2 && $cost->modality->id != 6) ? 'disabled' : '' ?> data-price="<?= $cost->value_full; ?>" type="radio" name="tipoTerapiaRadio">
                            <label for="uncheckedRadio" class="form-check-label body1">
                                <?= $cost->modality->name; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <br><br>
                    <p class="body1 bold modal_subtitle">Modo da sessão</p>


                    <?php if ($therapist->therapist->profile->attendance_by_video_call): ?>
                        <div class="form-check">
                            <input class="form-check-input therapy_mode" value="1" type="radio" name="tipoSessaoRadio">
                            <label for="uncheckedRadio" class="form-check-label body1">
                                Vídeo
                            </label>
                        </div>
                    <?php endif; ?>
                    <?php if ($therapist->therapist->profile->attendance_by_phone_call): ?>
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
                        <div class="col-8">
                            <div class="form-outline">
                                <span class="form-outline__icon material-icons-outlined">calendar_today</span>
                                <input class="form-control custom-datepicker input-calendar" placeholder="" required type="text" id="period-date" name="periodDate">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-outline">
                                <span class="form-outline__icon material-icons-outlined">schedule</span>
                                <input class="form-control input-calendar timepicker" required type="text" id="period-time" name="periodTime">
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            <input type="hidden" class="modal-hidden_fullDate">
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">CANCELAR</button>
                <button type="button" class="btn btn-primary" id="solicitar_agendamento" info-date="">SOLICITAR AGENDAMENTO</button>
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
                    Sua solicitação para agendar uma consulta com <?= $therapist->therapist->name; ?> foi enviada com sucesso! Aguarde <?= $therapist->therapist->name; ?> responder a solicitação para realizar o pagamento e garantir seu horário.
                </p>
            </div>
        </div>
    </div>
</div>
