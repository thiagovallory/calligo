<main id="accountType" class="main">
    <div class="container flex-fullcentered offset-header">
        <!-- <div class="row">
	       	<div class="col-lg-12">
				<h3>O que deseja alcançar com a Calligo?</h3>
				<p class="subtitle2">Escolha o tipo de conta de acordo com o seu objetivo para<br class="desktop">prosseguir com o cadastro e alçar vôos.</p>
			</div>
		</div> -->
		<div class="row d-flex justify-content-center">
			<!-- <div class="col-7 col-xl-6"> -->
			<div class="col-12 col-sm-8 col-xl-8">
				<div class="card-group">
				  <div class="card">
					<img src="/img/logo-psico.png" class="card-img-top" alt="">
				    <div class="card-body">
				      <h5 class="card-title">Sou Terapeuta</h5>
				      <p class="body1 text-center">Para psicólogos por formação, com desejo de evoluir, transformar vidas e a sua carreira profissional.</p>
				    </div>
				    <div class="card-footer">
				      <?php
					      	echo $this->Html->link('Cadastre-se',
					                ['controller' => 'Users', 'action' => 'add', '?'=>['role'=>2]],
					                ['class'=>'btn btn-bold btn-primary']
					        );
				      ?>
				    </div>
				  </div>
				  <div class="card">
				  	<img src="/img/logo-cliente.png" class="card-img-top" alt="">
				    <div class="card-body">
				      <h5 class="card-title">Quero Terapia</h5>
				      <p class="body1 text-center">Para quem busca um profissional que possa ajudar a transformar sua vida.</p>
				    </div>
				    <div class="card-footer">
				      
				      <?php
				      	echo $this->Html->link('Cadastre-se',
				                ['controller' => 'Users', 'action' => 'add', '?'=>['role'=>1]],
				                ['class'=>'btn btn-bold btn-secondary']
				        );
				      ?>
				      
				    </div>
				  </div>
				</div>

				<br class="mobile"><br class="mobile">
				<img class="mobile" src="/img/borboletas.png">
				<br class="mobile">
			</div>
		</div>
	</div>
</main>