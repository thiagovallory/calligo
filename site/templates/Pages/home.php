<?php
echo $this->element('head');
?>

<body id="home">
    <main class="main">
        <div id="intro-calligo" class="container-fluid component" cp-name="sliders">
            <div class="intro-slider">
                <div>
                    <div class="intro-text w-100 w-sm-50">
                        <div class="row">
                            <div class="col-md-5 col-xl-5 offset-md-1 text-start mobile-centered">
                                <img class="brandname desktop" src="/img/brandname.png" alt="Calligo.">
                                <img class="brandname mobile" src="/img/brandname-mobile.png" alt="Calligo.">
                                <h1 class="text-start mobile-centered">Ambiente de transformação <br>e evolução!</h1>
                                <p class="subtitle1 mobile-centered">
                                    Evolua a sua prática e cuide melhor dos seus pacientes, de qualquer lugar e em segurança.
                                    Conteúdos exclusivos e inéditos no Brasil para você, Terapeuta.<br>
                                    Quer desenvolver seu consultório virtual? Amplie seu alcance profissional através dos serviços customizados da Calligo.
                                </p>
                                <br>
                                <?php
                                    echo $this->Html->link('Quero transformar!',
                                            ['controller' => 'Users', 'action' => 'add_select_type'],
                                            ['class'=>'btn btn-bold btn-primary']
                                    );
                                ?>
                            </div>
                        </div>
                    </div>

                    <img src="img/home-banner-1.png" class="slider-image desktop">
                </div>

                <div>
                    <div class="intro-text w-100 w-sm-50">
                        <div class="row">
                            <div class="col-md-5 col-xl-5 offset-md-1 text-start mobile-centered">
                                <img class="brandname desktop" src="/img/brandname.png" alt="Calligo.">
                                <img class="brandname mobile" src="/img/brandname-mobile.png" alt="Calligo.">
                                <h1 class="text-start mobile-centered">Evolua</h1>
                                <p class="subtitle1 mobile-centered">
                                    Autoconhecimento na palma da sua mão. <br>
                                    Dê o primeiro passo para a sua transformação. Encontre um profissional independente e ideal para te ouvir.
                                </p>
                                <br>
                                <?php
                                    echo $this->Html->link('Quero evoluir!',
                                            ['controller' => 'Users', 'action' => 'search'],
                                            ['class'=>'btn btn-bold btn-primary']
                                    );
                                ?>
                            </div>
                        </div>
                    </div>

                    <img src="img/home-banner-1.png" class="slider-image desktop">
                </div>

                <div>
                    <div class="intro-text w-100 w-sm-50">
                        <div class="row">
                            <div class="col-md-5 col-xl-5 offset-md-1 text-start mobile-centered">
                                <img class="brandname desktop" src="/img/brandname.png" alt="Calligo.">
                                <img class="brandname mobile" src="/img/brandname-mobile.png" alt="Calligo.">
                                <br><br>
                                <p class="subtitle1 mobile-centered">
                                    Para transformar com nosso bater de asas e causar o efeito borboleta, contamos com cada pessoa alcançada. A Calligo quer tornar o acesso à saúde mental uma realidade de todos.
                                </p>
                                <br>
                                <button data-bs-toggle="modal" data-bs-target="#videomodal" class="play_video component" cp-name="play_video_modal"><img src="img/play.png"> Assista o vídeo</button>
                            </div>
                        </div>
                    </div>

                    <img src="img/home-banner-2.png" class="slider-image desktop">
                </div>
            </div>

            <div class="intro-image mobile">
                <img src="img/intro-image-mobile.png" class="slider-image">
            </div>
            <a class="help-button" href="/help"><img src="img/ajuda.png"></a>
        </div>
        <div id="for-whom" class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 offset-md-1 text-start">
                    <div class="tag primary text-start mobile"><p class="overline">PARA PSICÓLOGOS</p></div>
                    <img src="img/ilustracao-1.png" class="for-whom-ilustration">
                </div>
                <div class="col-lg-5 offset-md-1 text-start">
                    <div class="tag primary text-start desktop"><p class="overline">PARA PSICÓLOGOS</p></div>
                    <h2 class="text-start">
                        Conecte conosco para evoluir e transformar! <br class="mobile">Call I Go, seja Calligo.
                    </h2>
                    <p>
                        Para os Psicólogos que decidiram entregar o seu conhecimento em forma de orientação e auxílio no desenvolvimento da sociedade. Mas quem cuida de você? Seremos fonte de cuidado, respeito e profissionalismo, transformando sua carreira. <br>
                        Na Calligo você não se resume a quantidade de estrelas que te avaliam.
                    </p>
                    <br>
                    <?php
                        echo $this->Html->link('SAIBA MAIS',
                              ['controller' => 'Pages', 'action' => 'therapist'],
                              ['class'=>'btn btn-bold btn-primary']
                        );
                    ?>
                </div>
            </div>
            <br>
            <br>
            <div class="row align-items-center">
                <div class="col-lg-5 offset-md-1 text-start for-whom_text-mob">
                    <div class="tag secondary text-start"><p class="overline">PARA VOCÊ</p></div>
                    <img src="img/ilustracao-2.png" class="for-whom-ilustration mobile">
                    <h2 class="text-start">
                        Acreditamos na Transformação para Revolucionar
                    </h2>
                    <p>
                        Sabemos que cuidar da saúde mental não é uma realidade para todos, e que muitas vezes o que impede uma pessoa de procurar ajuda, está relacionado ao alto custo do investimento. <br>
                        Pensando nisso, a Calligo criou a Terapia de Alcance, a sua oportunidade para se desenvolver com profissionais que irão disponibilizar ajuda qualificada a um valor que está ao seu alcance.
                    </p>
                    <br>
                    <!-- <button class="btn btn-bold btn-secondary">SAIBA MAIS</button> -->
                </div>
                <div class="col-lg-4 offset-1 desktop">
                    <img src="img/ilustracao-2.png" class="for-whom-ilustration">
                </div>
            </div>
            <br>
            <br>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10 quote-block">
                    <img src="img/aspas-1.png" class="for-whom-quote">
                    <p class="quote-text">
                        Acreditamos no poder da transformação através de pequenos gestos. A Calligo veio para proporcionar o efeito borboleta, que com o seu bater de asas é capaz de gerar resultados significativos na vida das pessoas. Pequenas mudanças podem gerar grandes fenômenos. Seja a sua própria transformação!
                    </p>
                    <?php
                        echo $this->Html->link('SAIBA MAIS',
                              ['controller' => 'Pages', 'action' => 'manifest'],
                              ['class'=>'btn btn-bold btn-primary']
                        );
                    ?>
                    <img src="img/aspas-2.png" class="for-whom-quote">
                </div>
            </div>
        </div>
        <div class="container">
            <?= $this->element('home/whyTherapy') ?>
        </div>
        <?= $this->element('home/steps') ?>
        <div id="homeSearch">
            <h2>Encontre um Psicólogo</h2>
            <p class="subtitle1">Encontre aqui o Psicólogo que pode ajudar a transformar sua vida.</p>
            <?php echo $this->Form->create(null, [
                    'type' => 'get',
                    'url' => [
                        'controller' => 'Users',
                        'action' => 'search'
                    ]]);  ?>
                <input class="form-control" type="text" id="search" name="text" placeholder="Pesquisa...">
                <span class="search-icon material-icons-outlined">search</span>
                <?= $this->Form->button('Buscar', ['class' => 'btn btn-bold btn-light',]);?>
            <?= $this->Form->end() ?>
        </div>
    </main>
    <?php
    echo $this->element('footer');
    ?>
    <div class="modal fade" id="videomodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                 <video controls>
                    <source src="/videos/calligo_final_posterize.mp4" type="video/mp4">
                    Seu navegador não suporta vídeos HTML5.
                </video>
            </div>
        </div>
    </div>
    <?php echo $this->Html->script('vendors');?>
    <?php echo $this->Html->script('main');?>
</body>
</html>
