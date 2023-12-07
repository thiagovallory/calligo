<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Cancelamento de terapia',
		'alt_logo'=>'Calligo',
		'title'=>'', //se for vazio não imprime o título
		'content'=>'<p>O seu paciente <b>'.$data['patient']['name'].'</b> encerrou a terapia.</p>',
		'button_name'=>'', //se for vazio não imprime o botão
		'button_link'=>'',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>
<!-- O seu paciente <b><?= $data['patient']['name'];?></b> encerrou a terapia.  -->