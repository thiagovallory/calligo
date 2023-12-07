<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Recuperação de Senha',
		'alt_logo'=>'Calligo',
		'title'=>'Olá <span style="color:#5C02FF">'.$data['name'].'</span>',
		'content'=>'<p>Sua nova senha é <strong>'.$data['newPass'].'</strong></p>',
		'button_name'=>'', //se for vazio não imprime o botão
		'button_link'=>'',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>

<!-- <p>Olá <?php echo $data['name'];?></p>

<p>Sua nova senha é <strong><?php echo $data['newPass'];?></strong></p> -->