<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Encerramento de terapia',
		'alt_logo'=>'Calligo',
		'title'=>'', //se for vazio não imprime o título
		'content'=>'<p>Sua terapia com <b>'.$data['therapist']['name'].'</b> foi encerrada.</p>',
		'button_name'=>'', //se for vazio não imprime o botão
		'button_link'=>'',
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>
<!-- Sua terapia com <b><?= $data['therapist']['name'];?></b> foi encerrada.  -->