<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;
?>

<?php
echo $this->element('head');
?>

<body id="home">
    <?php echo $this->element('header');?>
    <main class="main">
        <div id="intro-calligo" class="container-fluid component" cp-name="sliders">
            <div class="intro-slider">
                <img src="img/home-banner-1.png" class="slider-image">
                <img src="img/home-banner-2.png" class="slider-image">
            </div>
            <div class="d-flex container h-100 align-items-center intro-text">
                <div class="row ">
                    <div class="col-md-5 col-xl-5 offset-md-1 text-start">
                        <img class="brandname" src="/img/brandname.png" alt="Calligo.">
                        <h1 class="text-start">Ambiente de transformação <br>e evolução!</h1>
                        <p class="subtitle1">Dê o primeiro passo para ser uma metamorfose na sua carreira e se torne um Psicólogo independente. Desenvolva seu consultório virtual e amplie seu alcance profissional.</p>
                        <br>
                        <button class="btn btn-bold btn-primary">Seja calligo!</button>
                        <button class="play_video"><img src="img/play.png"> Assista o vídeo</button>
                    </div>
                </div>
            </div>
            <a class="help-button" href="javascript:;"><img src="img/ajuda.png"></a>
        </div>
        <div id="for-whom" class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 offset-1">
                    <img src="img/ilustracao-1.png" class="for-whom-ilustration">
                </div>
                <div class="col-lg-5 offset-1 text-start">
                    <div class="tag primary text-start"><p class="overline">PARA PSICÓLOGOS</p></div>
                    <h2 class="text-start">
                        Conecte-se conosco para evoluir e transformar. Seja Calligo.
                    </h2>
                    <p>
                        Para os Psicólogos que decidiram entregar o seu conhecimento em forma de orientação e auxílio no desenvolvimento da sociedade. Mas quem cuida de você? Seremos fonte de cuidado, respeito e profissionalismo, transformando sua carreira. <br>
                        Na Calligo você não se resume a quantidade de estrelas que te avaliam. 
                    </p>
                    <br>
                    <button class="btn btn-bold btn-primary">SAIBA MAIS</button>
                </div>
            </div>
            <br>
            <br>
            <div class="row align-items-center">
                <div class="col-lg-5 offset-1 text-start">
                    <div class="tag secondary text-start"><p class="overline">PARA VOCÊ</p></div>
                    <h2 class="text-start">
                        Acreditamos na Transformação para Revolucionar
                    </h2>
                    <p>
                        Sabemos que cuidar da saúde mental não é uma realidade para todos, e que muitas vezes o que impede uma pessoa de procurar ajuda, está relacionado ao alto custo do investimento. <br>
                        Pensando nisso, a Calligo criou a Terapia de Alcance, a sua oportunidade para se desenvolver com profissionais que irão disponibilizar ajuda qualificada a um valor que está ao seu alcance.
                    </p>
                    <br>
                    <button class="btn btn-bold btn-secondary">SAIBA MAIS</button>
                </div>
                <div class="col-lg-4 offset-1">
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
                    <button class="btn btn-primary">SAIBA MAIS</button>
                    <img src="img/aspas-2.png" class="for-whom-quote">
                </div>
            </div>
        </div>
        <div class="container">
            <?= $this->element('home/whyTherapy') ?>
        </div>
        <div class="container">
            <?= $this->element('home/steps') ?>
        </div>
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
    <?php echo $this->Html->script('vendors');?>
    <?php echo $this->Html->script('main');?>    
</body>
</html>
