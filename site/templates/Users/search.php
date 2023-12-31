<div id="search_page" class="component offset-header" cp-name="searchPage">
    <div id="homeSearch">
        <?php echo $this->Form->create(null, ['type' => 'get']); ?>
        <div class="form-container">
            <h1>Encontre um Terapeuta</h1>
            <p class="subtitle1">Encontre um terapeuta independente para cuidar de você!</p>

            <?php if ($_isMobile): ?>
                <div class="row">
                    <div class="col-12">
                        <input name="text" value="<?= $inputs['text']; ?>" placeholder="Pesquisar..." class="form-control" id="search" />
                    </div>

                    <div class="col-12 mb-4">
                        <?= $this->Form->button('Procurar', array('class' => 'form-control btn btn-bold btn-white w-100',)); ?>
                    </div>

                    <div class="col-12">
                        <button class="form-control btn btn-bold btn-primary btn_filter w-100">
                            Filtrar <img class="icon-filter" src="../img/icon-filter.png">
                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-8 search_column">
                        <input name="text" value="<?= $inputs['text']; ?>" placeholder="Pesquisar..." class="form-control" id="search" />
                        <span class="search-icon material-icons-outlined">search</span>
                    </div>
                    <div class="col">
                        <?= $this->Form->button('Procurar', array('class' => 'form-control btn btn-bold btn-white',)); ?>
                    </div>
                    <div class="col filter-column">
                        <button class="form-control btn btn-bold btn-primary btn_filter">Filtrar</button>
                        <img class="icon-filter" src="../img/icon-filter.png">
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($_isMobile): ?>
            <div class="filter_container">
                <div class="filter_content">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple class="form-select" name="problems[]">
                                    <option value=""></option>
                                    <?php foreach ($selects['problems'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Preciso de ajuda com</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple class="form-select" name="session_type[]">
                                    <option value=""></option>
                                    <?php foreach ($selects['session_type'] as $key => $obj): ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Tipo de sessão</label>
                            </div>
                        </div>
                        <?php
                        if ($_userLogged && !$_userLogged['role'] == 2): ?>
                            <div class="col-12">
                                <div class="form-outline multiple_select-container">
                                    <select multiple class="form-select" name="attendance_type[]">
                                        <option value=""></option>
                                        <?php foreach ($selects['attendance_type'] as $key => $obj) : ?>
                                            <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="" class="form-label body1" for="select1">Tipo de atendimento</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 mb-4">
                            <div class="form-outline required">
                                <input type="text" class="form-control" name="cost_value" value="" data-min="<?= $inputs['cost_value']['min']; ?>" data-max="<?= $inputs['cost_value']['max']; ?>" data-start="<?= $inputs['cost_value']['start']; ?>" data-end="<?= $inputs['cost_value']['end']; ?>" />
                                <label class="form-label body1" for="campo1">Valor por sessão
                                    entre <?= $inputs['cost_value']['start'] . ' e ' . $inputs['cost_value']['end']; ?></label>
                                <span class="help-message"></span>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="therapies[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['therapies'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Abordagem</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="ages[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['ages'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Pra quem é a terapia</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="gender" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['genders'] as $key => $obj) {
                                        $selected = ($this->request->getQuery('gender') == $key) ? 'selected' : null;
                                        echo '<option value="' . $key . '" ' . $selected . '>' . $obj . '</option>';
                                    } ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Gênero do Psicólogo</label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-outline required">
                                <input type="text" class="form-control" name="time_work_experience" value="" data-min="<?= $inputs['time_work_experience']['min']; ?>" data-max="<?= $inputs['time_work_experience']['max']; ?>" data-start="<?= $inputs['time_work_experience']['start']; ?>" data-end="<?= $inputs['time_work_experience']['end']; ?>" />
                                <label class="form-label body1" for="campo1">Tempo de experiência
                                    entre <?= $inputs['time_work_experience']['start'] . ' e ' . $inputs['time_work_experience']['end'] . ' anos'; ?></label>
                                <span class="help-message"></span>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="langs[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['langs'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Idiomas</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="characteristics[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['characteristics'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Característica do
                                    profissional</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="crp_origin" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['states'] as $key => $obj) {
                                        $selected = ($this->request->getQuery('state') == $key) ? 'selected' : null;
                                        echo '<option value="' . $key . '" ' . $selected . '>' . $obj . '</option>';
                                    } ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Estado do CRP</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="filter_container">
                <div class="filter_content">
                    <div class="row">
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple class="form-select" name="problems[]">
                                    <option value=""></option>
                                    <?php foreach ($selects['problems'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Preciso de ajuda com</label>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple class="form-select" name="session_type[]">
                                    <option value=""></option>
                                    <?php foreach ($selects['session_type'] as $key => $obj): ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Tipo de sessão</label>
                            </div>
                        </div>
                        <?php
                        if ($_userLogged && !$_userLogged['role'] == 2): ?>
                            <div class="col px-2">
                                <div class="form-outline multiple_select-container">
                                    <select multiple class="form-select" name="attendance_type[]">
                                        <option value=""></option>
                                        <?php foreach ($selects['attendance_type'] as $key => $obj) : ?>
                                            <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="" class="form-label body1" for="select1">Tipo de atendimento</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col px-2">
                            <div class="form-outline required">
                                <input type="text" class="form-control" name="cost_value" value="" data-min="<?= $inputs['cost_value']['min']; ?>" data-max="<?= $inputs['cost_value']['max']; ?>" data-start="<?= $inputs['cost_value']['start']; ?>" data-end="<?= $inputs['cost_value']['end']; ?>" />
                                <label class="form-label body1" for="campo1">Valor por sessão
                                    entre <?= $inputs['cost_value']['start'] . ' e ' . $inputs['cost_value']['end']; ?></label>
                                <span class="help-message"></span>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="therapies[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['therapies'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Abordagem</label>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="ages[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['ages'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Pra quem é a terapia</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="gender" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['genders'] as $key => $obj) {
                                        $selected = ($this->request->getQuery('gender') == $key) ? 'selected' : null;
                                        echo '<option value="' . $key . '" ' . $selected . '>' . $obj . '</option>';
                                    } ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Gênero do Psicólogo</label>
                            </div>
                        </div>

                        <div class="col px-2">
                            <div class="form-outline required">
                                <input type="text" class="form-control" name="time_work_experience" value="" data-min="<?= $inputs['time_work_experience']['min']; ?>" data-max="<?= $inputs['time_work_experience']['max']; ?>" data-start="<?= $inputs['time_work_experience']['start']; ?>" data-end="<?= $inputs['time_work_experience']['end']; ?>" />
                                <label class="form-label body1" for="campo1">Tempo de experiência
                                    entre <?= $inputs['time_work_experience']['start'] . ' e ' . $inputs['time_work_experience']['end'] . ' anos'; ?></label>
                                <span class="help-message"></span>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="langs[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['langs'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Idiomas</label>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="characteristics[]" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['characteristics'] as $key => $obj) : ?>
                                        <option value="<?= $obj['id'] ?>" <?= $obj['selected'] ?>><?= $obj['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Característica do
                                    profissional</label>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-outline multiple_select-container">
                                <select multiple name="crp_origin" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($selects['states'] as $key => $obj) {
                                        $selected = ($this->request->getQuery('state') == $key) ? 'selected' : null;
                                        echo '<option value="' . $key . '" ' . $selected . '>' . $obj . '</option>';
                                    } ?>
                                </select>
                                <label for="" class="form-label body1" for="select1">Estado do CRP</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?= $this->Form->end() ?>
    </div>
    <div class="main content">
        <?php foreach ($users as $user) {
            echo $_isMobile ?
                $this->element('Search/card_user_mobile', [
                    'schedule_settings' => $user['data'][0],
                    'week_days'         => $user['data'][1],
                    'week'              => $user['data'][2],
                    'time_zones'        => $user['data'][3],
                    'month'             => $user['data'][4],
                    'year'              => $user['data'][5],
                    'user'              => $user
                ]) : $this->element('Search/card_user', [
                    'schedule_settings' => $user['data'][0],
                    'week_days'         => $user['data'][1],
                    'week'              => $user['data'][2],
                    'time_zones'        => $user['data'][3],
                    'month'             => $user['data'][4],
                    'year'              => $user['data'][5],
                    'user'              => $user
                ]);
        } ?>

        <?php echo $this->element('paginate'); ?>
    </div>
</div>
