<div id="shcedulesPage" data-role="<?= $_userLogged['role'] ?>" class="container dashboard-content component" cp-name="calendar">
    <div class="content-header">
        <div class="calendar__header">

            <!-- <div class="btn-group calendar__btn-group" role="group" aria-label="Basic example">
                <div class="calendar__btn-group__item">
                    <button type="button" class="calendar__header-button btn active" data-calendar-format="month">Mês</button>
                </div>
                <div class="calendar__btn-group__item">
                    <button type="button" class="calendar__header-button btn" data-calendar-format="week">Semana</button>
                </div>
                <div class="calendar__btn-group__item">
                    <button type="button" class="calendar__header-button btn" data-calendar-format="day">Dia</button>
                </div>
            </div> -->
            <div class="calendar__header-selector">
                <div class="calendar__arrows">
                    <a href="#" class="link__previous-month">
                        <span class="material-icons-outlined">keyboard_arrow_left</span>
                    </a>
                    <h4 id="selected-month"></h4>
                    <a href="#" class="link__next-month">
                        <span class="material-icons-outlined">keyboard_arrow_right</span>
                    </a>
                </div>
                <span id="selected-year"></span>
            </div>

            <?php if ($_userLogged['role'] == 2) : ?>
                <div class="calendar__block">
                    <button class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#blockModal">
                        BLOQUEAR HORÁRIO
                    </button>
                </div>
            <?php endif ?>


            <?php if ($_userLogged['role'] == 1) : ?>
                <div class="calendar__block">
                    <a class="btn btn-primary client-appointment" href="<?= $appointmentPath; ?>">
                        <span class="material-icons-outlined">add</span>
                        <span>NOVO AGENDAMENTO</span>
                    </a>
                </div>
            <?php endif ?>

                <!-- <div class="calendar__header-filter">
                <a class="calendar__header-filter__search" href="#">
                    <span class="material-icons">search</span>
                </a>
                <button class="btn btn-outline-primary btn-labeled">
                    Calendário
                    <span class="material-icons-outlined">expand_more</span>
                </button>
                <button class="btn btn-primary btn-labeled">
                    <span class="material-icons-outlined">add</span>
                    ADICIONAR
                </button>
            </div> -->
        </div>
    </div>
    <div class="content-body">
        <div class="box box__calendar">
            <div class="calendar__content">
                <div class="calendar__monthly">
                    <div class="calendar-content calendar__weekdays calendar__weekdays--monthly"></div>
                    <div class="calendar-content calendar__monthly-days"></div>
                </div>
                <div class="calendar__weekly">
                    <div class="calendar-content calendar__weekdays calendar__weekdays--weekly"></div>
                    <div class="calendar-content calendar__weekly-days"></div>
                </div>
                <div class="calendar__daily">
                    <div class="calendar-content calendar__weekdays calendar__weekdays--daily"></div>
                    <div class="calendar-content calendar__daily-days"></div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if ($_userLogged['role'] == 2) {
            echo $this->element('schedules/block-modal');
            echo $this->element('schedules/unblock-modal');
        } else {
            echo $this->element('agenda/agenda-box-modal');
        }

        echo $this->element('schedules/appointments-modal');
        echo $this->element('schedules/confirmation-modal');
        echo $this->element('schedules/patient-modal'); 
    ?>

</div>
