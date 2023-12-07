<?php $link_payment= $this->Url->build(['controller'=>'Appointments','action'=>'payment', $data['id'],'_full' => true,'prefix'=>false]);?>
<?=$this->element('email/body', [
	'data'=>[
		'subject'=>'Confirmação de consulta',
		'alt_logo'=>'Calligo',
		'title'=>'Olá <span style="color:#5C02FF">'.$data['patient']['name'].'</span>', //se for vazio não imprime o título
		'content'=>'<p>Sua consulta foi solicitada com sucesso, faço o pagamento clicando no botão abaixo para confirmá-la.</p>
        <br>
        <p>Se não conseguir clicar, copie o link '.$link_payment.' e cole em seu navegador.</p>',
		'button_name'=>'REALIZAR PAGAMENTO', //se for vazio não imprime o botão
		'button_link'=>$link_payment,
		'unsub_name'=>'CANCELAR SUBSCRIÇÃO',
		'unsub_link'=>'https://calligo.com.br/unsubscribe'
	]
]);?>

<!-- <p>Olá <b><?=$data['patient']['name'];?></b></p>
<br>
<p>Sua consulta foi solicitada com sucesso, faço o pagamento clicando no botão abaixo para confirmá-la.</p>
<br>
<p>Se não conseguir clicar, copie o link <?=$link_payment;?> e cole em seu navegador.</p> -->