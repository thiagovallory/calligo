<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Ativação de Cadastro',
		'alt_logo'=>'Calligo',
		'title'=>'Olá <span style="color:#5C02FF">'.$data['name'].'</span>',
		'content'=>'<p>Você está a um passo de iniciar sua jornada com a Calligo.
		<br>
		Clique no botão abaixo para ativar seu cadastro. </p>',
		'button_name'=>'CONFIRMAR E-MAIL', //se for vazio não imprime o botão
		'button_link'=>$data['link_active'],
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>

<!-- <p>Olá <?php echo $data['name'];?></p>

<p><a href="<?php echo $data['link_active'];?>">Clique aqui</a> para ativar seu cadastro</p> -->
