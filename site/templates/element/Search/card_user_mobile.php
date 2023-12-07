<div class="card_user-result">
    <div class="row">
        <div class="col-sm-12 col-lg-6 card_user-text-block">
            <div class="row card_user-header">
                <div class="col-3">
                    <img class="card_user-photo rounded-circle" src="<?= $user->profile->photo; ?>" />
                </div>
                <div class="col-9">
                    <p class="h4"><?= $user->name; ?></p>
                    <p class="body1">CRP <?= $user->profile->crp; ?></p>
                </div>
            </div>

            <div class="col">
                <p class="h4">R$ 100</p>
                <p class="body1"><?= $user->profile->session_duration; ?>min</p>
            </div>

            <p class="h5">ESPECIALIDADES</p>
            <div class="box__tag-wrapper">
                <?php foreach ($user->specialties as $speciality) : ?>
                    <div class="box-tag">
                        <p class="body1"><?= $speciality->name ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <?= $this->Html->link(__('VER PERFIL'), ['action' => 'profile', $user->id], ['class' => 'card_user-see-profile body1']); ?>
        </div>
    </div>
</div>
