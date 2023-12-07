<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Assunto teste_jonathan',
		'alt_logo'=>'Calligo',
		'title'=>'Olá <span style="color:#5C02FF">Fulano de Tal</span>',  //se for vazio não imprime o título
		'content'=>'<p>Você está a um passo de iniciar sua jornada com a Calligo.
		<br>
		Clique no botão abaixo para ativar seu cadastro. </p>',
		'button_name'=>'CONFIRMAR E-MAIL', //se for vazio não imprime o botão
		'button_link'=>$url.'//link',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>