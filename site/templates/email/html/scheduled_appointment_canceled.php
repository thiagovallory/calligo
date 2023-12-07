<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Agenda cancelada',
		'alt_logo'=>'Calligo',
		'title'=>'', //se for vazio não imprime o título
		'content'=>'<p>Sua solicitação de agendamento foi cancelada.</p>',
		'button_name'=>'', //se for vazio não imprime o botão
		'button_link'=>'',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>
<!-- Sua solicitação de agendamento foi cancelada. -->