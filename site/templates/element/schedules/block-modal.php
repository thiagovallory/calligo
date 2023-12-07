<div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
  <div class="modal-dialog time-lock__modal modal-dialog-centered" role="document">
    <form id="lock-time-form" method="post">
      <div class="modal-content component" cp-name="blockModal">
        <div class="modal-header">
          <h5 class="modal-title" id="blockModalLabel">Bloquear Horário</h5>
          <button type="button" class="material-icons text__gray70 btn-close" data-bs-dismiss="modal" aria-label="Close">close</button>
        </div>
        <div class="modal-body component" cp-name="inputDate">
              <div class="row">
                  <div class="col-12">
                    <label for="" class="form-label body1" for="select1">Início</label>
                  </div>
                  <div class="col-8">
                      <div class="form-outline">
                          <span class="form-outline__icon material-icons-outlined">calendar_today</span>
                          <input class="form-control custom-datepicker input-calendar" placeholder="" required type="text" id="start-date" name="startDate">
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="form-outline">
                          <span class="form-outline__icon material-icons-outlined">schedule</span>
                          <input class="form-control input-calendar timepicker" required type="text" id="start-time" name="startTime">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                    <label for="" class="form-label body1" for="select1">Término</label>
                  </div>
                  <div class="col-8">
                    <div class="form-outline">
                        <span class="form-outline__icon material-icons-outlined">calendar_today</span>
                        <input class="form-control custom-datepicker input-calendar" placeholder="" required type="text" id="end-date" name="endDate">
                    </div>
                  </div>
                  <div class="col-4">
                      <div class="form-outline">
                          <span class="form-outline__icon material-icons-outlined">schedule</span>
                          <input class="form-control input-calendar timepicker" required type="text" id="end-time" name="endTime">
                      </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submit" id="block-submit" class="btn btn-primary">SALVAR</button>
        </div>
      </div>
    </form>
  </div>
</div>