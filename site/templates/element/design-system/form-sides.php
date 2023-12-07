<p class="caption">Form em uma coluna de tamanho 6 (usando rows e cols do bootstrap para os campos ficarem bem distribuidos dentro do form) [Inspecionar o código para ver a estrutura]</p>
<form>

    <div class="row">
        <div class="col">
            <!-- input -->
            <div class="form-outline required">
            <input type="text" placeholder="Placeholder text" id="campo1" class="form-control" />
            <label class="form-label body1" for="campo1">Campo de texto normal</label>
            <span class="help-message"></span>
            <span class="error-message"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
            <input type="text" id="campo3" disabled class="form-control active" value="Campo preenchido e desabilitado" />
            <label class="form-label body1" for="campo3">Nome do campo</label>
            <span class="help-message"></span>
            <span class="error-message">Mensagem de erro</span>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col">
                <div class="form-outline">
                    <input class="form-control" type="date" id=date-field">
                    <label for="date-field" class="form-label body">Campo Data</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <input type="text" id="campo2" class="form-control" />
                <label class="form-label body1" for="campo2">Campo com ajuda</label>
                <span class="help-message">Texto de ajuda</span>
                <span class="error-message"></span>
            </div>
        </div>
        <div class="col">
            <div class="form-outline value-error">
                <input type="text" id="campo3" class="form-control" />
                <label class="form-label body1" for="campo3">Campo com erro</label>
                <span class="help-message"></span>
                <span class="error-message">Mensagem de erro</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- Password input -->
            <div class="form-outline">
                <input type="text" id="campo4" class="form-control active" value="Campo Preenchido" />
                <label class="form-label body1" for="campo4">Nome do campo</label>
                <span class="help-message"></span>
                <span class="error-message"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <input type="text" id="campo2" disabled class="form-control" />
                <label class="form-label body1" for="campo2">Campo desabilitado</label>
                <span class="help-message">Texto de ajuda</span>
                <span class="error-message"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <select class="form-select" name="" id="select1">
                    <option></option>
                    <option value="1">Selecionado</option>
                </select>
                <label for="" class="form-label body1" for="select1">Título do select</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <select class="form-select" disabled name="" id="select1">
                    <option selected>Select desabilitado com título</option>
                    <option value="1">Selecionado</option>
                </select>
                <label for="" class="form-label body1" for="select1">Título do select</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <select class="form-select" disabled name="" id="select1">
                    <option selected>Select desabilitado</option>
                    <option value="1">Selecionado</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <select class="form-select" name="" id="select1">
                    <option selected>Select texto ajuda</option>
                    <option value="1">Selecionado</option>
                </select>
                <span class="help-message">Texto de ajuda</span>
                <span class="error-message"></span>
            </div>
        </div>
        <div class="col">
            <div class="form-outline value-error">
                <select class="form-select" name="" id="select2">
                    <option></option>
                    <option value="1">Selecionado</option>
                </select>
                <label for="" class="form-label body1" for="select2">Título do select</label>
                <span class="help-message"></span>
                <span class="error-message">Mensagem de erro</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="uncheckedCheckbox">
                <label class="form-check-label body1" for="uncheckedCheckbox">
                    Unchecked checkbox
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkedCheckbox" checked>
                <label class="form-check-label body1" for="checkedCheckbox">
                    Checked checkbox
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" disabled value="" id="uncheckedCheckboxDisabled">
                <label class="form-check-label body1" for="uncheckedCheckboxDisabled">
                    Unchecked checkbox disabled
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" disabled value="" id="checkedCheckboxDisabled" checked>
                <label class="form-check-label body1" for="checkedCheckboxDisabled">
                    Checked checkbox disabled
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="uncheckedRadio" id="uncheckedRadio">
                <label for="uncheckedRadio" class="form-check-label body1">
                    Unchecked radio
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="uncheckedRadio" id="checkedRadio" checked>
                <label for="checkedRadio" class="form-check-label body1">
                    Checked radio
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="uncheckedRadio" id="uncheckedRadioDisabled" disabled>
                <label for="uncheckedRadioDisabled" class="form-check-label body1">
                    Unchecked radio disabled
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="checkedRadioDisabled" id="checkedRadioDisabled" disabled checked>
                <label for="checkedRadioDisabled" class="form-check-label body1">
                    Checked radio disabled
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-outline value-error">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="uncheckedRadio" id="checkboxError">
                    <label for="checkboxError" class="form-check-label body1">
                       Checkbox with error
                    </label>
                </div>
                <span class="error-message">Mensagem de erro</span>
            </div>
        </div>

        <div class="col">
            <div class="form-outline value-error">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="uncheckedRadio" id="radioError">
                    <label for="radioError" class="form-check-label body1">
                       Radio with error
                    </label>
                </div>
                <span class="error-message">Mensagem de erro</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-bold btn-primary">.btn.btn-bold.btn-primary</button>
        </div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary">.btn.btn-outline-primary</button>
        </div>
    </div>
    <div class="row">
    </div>
</form>
