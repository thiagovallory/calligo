<main id="login" class="main component no-model" cp-name="login">
    <div class="container-fluid">
        <div class="row no-gutter wrapper">
	       	<div class="col-lg-6">
				<div class="container flex-fullcentered">
					<div class="col-md-9 offset-md-1">

						<div id="loginForm">
							<div class="form-wrapper col-md-11">
								<h3>É bom ver você evoluindo!</h3>
								<br class="mobile">
								<p class="text-center">Faça seu login e continue sua transformação.</p>
								<br class="mobile">
								<?= $this->Form->create() ?>
								<?= $this->Form->input('username', array(
										'class' => 'form-control',
							    		'placeholder' => 'E-mail'
							    ));?>
							    <br class="mobile">
							    <div class="pwd-wrapper">
									<?= $this->Form->input('password', array(
											'class' => 'form-control password-field',
											'type' => 'password',
								    		'placeholder' => 'Senha'
								    ));?>	
								    <span class="icon-on material-icons-outlined">visibility</span>
								    <span class="icon-off material-icons-outlined">visibility_off</span>
<!-- 								    
									<i class="fas fa-eye"></i>
								    <i class="fas fa-eye-slash"></i>

 -->							    </div>
							    <?php echo $this->Flash->render(); ?>
							    <br class="mobile">
							    <?= $this->Form->button('Entrar', array(
										'class' => 'form-control btn btn-primary text-center',
							    ));?>
								<?= $this->Form->end() ?>							
							</div>
							<br>
							<p class="text-gray text-center"><a href="javascript:;" id="btnForgot">Esqueceu a senha?</a></p>
							<p class="text-gray text-center">Ainda não se conectou com a Calligo? 
							      <?php
							        echo $this->Html->link('Cadastre-se',
							                ['controller' => 'Users', 'action' => 'add_select_type']
							        );
							      ?>
							</p>
						</div>
						<div id="forgotPwd">
							<div class="form-wrapper col-md-11">
								<h3>Esqueceu sua senha?</h3>
								<br class="mobile">
								<p class="text-center">Informe seu e-mail para enviarmos sua nova senha.</p>
								<br class="mobile">
								<form>
										<input type="input" id="resetPwdUsername" class="form-control" placeholder="E-mail">
										<div class="error-message" style="display: none;">E-mail não encontrado.</div>
										<br class="mobile">
										<button class="form-control btn-primary" id="btnResetPassword">Enviar</button>
								</form>						
							</div>
						</div>
						<div id="pwdSent">
							<div class="form-wrapper col-md-11">
								<h3>E-mail enviado!</h3>
								<br class="mobile">
								<p class="text-center">Confira o e-mail que enviamos com a sua nova senha!</p>
								<br class="mobile">
								<form>
										<input type="hidden" id="resendUsername" class="form-control">
									    <button class="btn btn-bold btn-primary" id="btnStart">Início</button>		
									    <br class="mobile">										
										<button class="btn btn-bold btn-outline-primary" id="btnResendPassword">Reenviar Link</button>
								</form>											
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 login-slider desktop desktopFlex">
				<div class="slider">
					<div class="slide-item">
						<img src="/img/ilustra-login.png" alt="">
						<!-- <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h4>
						<a href="#" class="btn btn-outline-dark">Saiba Mais</a> -->
					</div>
					<!-- <div class="slide-item">
						<img src="/img/ilustra-login.png" alt="">
						<h4>Consectetur adipiscing elit</h4>
						<a href="#" class="btn btn-outline-dark">Saiba Mais</a>
					</div>
					<div class="slide-item">
						<img src="/img/ilustra-login.png" alt="">
						<h4>Lorem ipsum dolor sit amescing elit</h4>
						<a href="#" class="btn btn-outline-dark">Saiba Mais</a>
					</div>
					<div class="slide-item">
						<img src="/img/ilustra-login.png" alt="">
						<h4>Ipsum dolor sit amet, consectetur adipiscing elit</h4>
						<a href="#" class="btn btn-outline-dark">Saiba Mais</a>
					</div>	 -->				
				</div>
			</div>
			<div class="col-12 mobile">
				<img src="/img/ilustra-login-mobile.png" style="width: 100%;">
			</div>
        </div>
    </div>
</main>