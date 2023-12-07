<div class="modal fade patient-modal" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
  <div class="modal-dialog patient-modal__dialog modal-dialog-centered" role="document">
    <div class="modal-content component" cp-name="patientModal">
      <div class="modal-header">
        <div class="patient-modal__top-detail">
            <div>
              <img id="patient-image" class="patient-modal__image" src="" alt="">
            </div>
            <div>
                <h4 id="patient-name" class="patient-modal__name subtitle1"></h4>
                <p class="patient-modal__appointment body1">
                  <span id="appointment__weekday"></span>, <span id="appointment__day"></span> de <span id="appointment__month"></span> - <span id="appointment__start-time"></span> às <span id="appointment__end-time"></span>
                </p>
            </div>
        </div>
        <div class="patient-modal__buttons">
            <!-- <button type="button" class="patient-modal__header-button material-icons text__gray70">call</button>
            <button type="button" class="patient-modal__header-button material-icons text__gray70">chat_bubble_outline</button> -->
            <button type="button" class="patient-modal__header-button material-icons text__gray70" data-bs-dismiss="modal" aria-label="Close">close</button>
        </div>
      </div>
      <div class="modal-body">
          <div class="body1 patient-modal__body">
            <div>
              <strong>Status da terapia</strong>
            </div>
            <div class="patient-modal__container-status">
            </div>
            <div>
              <strong>Tipo de terapia</strong>
            </div>
            <div>
              <span class="patient-modal__value" id="patient-therapy"></span>
            </div>
            <div>
              <strong>Modo da terapia</strong>
            </div>
            <div>
              <span class="patient-modal__value">Vídeo</span>
            </div>
          </div>
          <div class="patient-modal__footer"></div>
      </div>
    </div>
  </div>
</div>