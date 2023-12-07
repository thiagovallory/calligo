<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Calligo</b>Admin</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Entre com suas credenciais</p>
            <?= $this->Form->create() ?>
                <div class="input-group mb-3">
                    <input type="email" name="username" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-4 ">
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>

                </div>
            <?= $this->Form->end() ?>
        </div>

    </div>
</div>
