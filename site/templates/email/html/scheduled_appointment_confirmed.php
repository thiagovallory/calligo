<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Consulta confirmada',
		'alt_logo'=>'Calligo',
		'title'=>'Olá <span style="color:#5C02FF">'.$data['patient']['name'].'</span>', //se for vazio não imprime o título
		'content'=>'<p>O agendamento da sua consulta foi confirmado. Fique atento ao dia e horário marcado.</p>',
		'button_name'=>'', //se for vazio não imprime o botão
		'button_link'=>'',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>
<!-- <p>Olá <b><?=$data['patient']['name'];?></b></p>
<br>
<p>O agendamento da sua consulta foi confirmado. Fique atento ao dia e horário marcado.
<br> -->