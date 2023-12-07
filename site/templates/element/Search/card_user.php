<div class="card_user-result">
    <div class="row">
        <div class="col-2">
            <img class="card_user-photo rounded-circle" src="<?= $user->profile->photo; ?>" />
        </div>
        <div class="col-6 card_user-text-block">
            <div class="row card_user-header">
                <div class="col-9">
                    <p class="h4"><?= $user->name; ?></p>
                    <p class="body1">CRP <?= $user->profile->crp; ?></p>
                </div>
                <div class="col">
                    <p class="h4">R$ 100</p>
                    <p class="body1"><?= $user->profile->session_duration; ?>min</p>
                </div>
            </div>
            <p class="h5">SOBRE</p>
            <p class="body1"><?= $user->profile->description; ?></p>

            <p class="h5">ESPECIALIDADES</p>
            <div class="box__tag-wrapper">
                <?php foreach ($user->specialties as $speciality) : ?>
                    <div class="box-tag">
                        <p class="body1"><?= $speciality->name ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <?= $this->Html->link(__('MAIS SOBRE '.strtoupper($user->name)), ['action' => 'profile', $user->id], ['class' => 'card_user-see-profile body1']); ?>
        </div>
        <div class="col-4">
            <?php echo $this->element('agenda/agenda-box', [
                'hasComponent'      => false,
                'hasHeader'         => false,
                'schedule_settings' => $schedule_settings,
                'week_days'         => $week_days,
                'week'              => $week,
                'time_zones'        => $time_zones,
                'month'             => $month,
                'year'              => $year,
                'user'              => $user]);
            ?>
        </div>
    </div>
</div>
