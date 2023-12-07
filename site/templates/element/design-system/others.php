<section id="other" class="box">
    <h4>Outros<button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#others_content" role="button" aria-expanded="false" aria-controls="others_content">Ver Mais</button></h4>
    <div class="collapse" id="others_content">
        <br />
        <hr />
        <div class="component" cp-name="customPopover">
            <div class="custom-popover__content" id="popover-select">
                <ul class="list--clean-style content-popover-select">
                    <li><a data-id="1" class="popover__anchor" href="#">Atividades entre sessões</a></li>
                    <li><a data-id="2" class="popover__anchor" href="#">Autorização de contato</a></li>
                    <li><a data-id="3" class="popover__anchor" href="#">Contrato de psicoterapia</a></li>
                    <li><a data-id="4" class="popover__anchor" href="#">Contrato de terapia de alcance</a></li>
                    <li><a data-id="5" class="popover__anchor" href="#">Contrato de supervisão</a></li>
                    <li><a data-id="6" class="popover__anchor" href="#">Escala</a></li>
                    <li><a data-id="7" class="popover__anchor" href="#">Hipótese diagnóstica</a></li>
                    <li><a data-id="8" class="popover__anchor" href="#">Relatório</a></li>
                    <li><a data-id="9" class="popover__anchor" href="#">Plano de segurança</a></li>
                    <li><a data-id="10" class="popover__anchor" href="#">Plano de tratamento</a></li>
                    <li><a data-id="11" class="popover__anchor" href="#">Testes psicológicos</a></li>
                </ul>
            </div>

            <button type="button" 
                    class="btn btn-lg btn-danger" 
                    rel="popover" title="Popover title" 
                    data-text-align="left"
                    data-callback-function="openModal"
                    data-anchor-close="true"
                    data-target="popover-select">
                Botão com submenu
            </button>

        </div>
    </div>
</section>
