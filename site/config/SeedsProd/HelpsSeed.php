<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Helps seed.
 */
class HelpsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'SubjectHelpsSeed',
        ];
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'              => 1,
                'name'            => 'O que é a CALLIGO?',
                'description'     => 'A CALLIGO é uma plataforma em prol da Saúde Mental. Um ecossistema que conecta psicólogos com outros psicólogos, com pacientes, e além disso, conta com uma variedade de serviços/ferramentas pensados exclusivamente na saúde e bem-estar de todos, no cuidado com a saúde mental, e no crescimento mútuo. Tudo isso de forma gratuita, realizado através do cadastro na plataforma, ambiente tanto do profissional que cuida e recebe cuidados, e ainda do paciente em busca de um tratamento de qualidade.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 2,
                'name'            => 'Como funciona a CALLIGO?',
                'description'     => 'A CALLIGO é uma plataforma online, disponível através do Mobile ou Computador, que atua na intermediação do cuidado com a saúde mental. Através de sua plataforma, os psicólogos e pacientes realizam seu cadastro de forma bastante rápida, sem custo, passando a ter acesso as essas ferramentas que vão além da Terapia convencional, até ao seu próprio crescimento/desenvolvimento. As sessões online são realizadas de acordo com suas preferências de valor, e agenda.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 3,
                'name'            => 'Quem faz parte da equipe da CALLIGO?',
                'description'     => 'A CALLIGO conta com um time multidisciplinar composto por profissionais de diversos segmentos de atuação. Nosso time é composto por profissionais técnicos em psicologia (no Brasil, e no Exterior), financeiro, advogados, tecnologia, comunicação e marketing.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 4,
                'name'            => 'A Plataforma da Calligo é segura?',
                'description'     => 'Sim! Segurança é um princípio básico e extremamente relevante para a CALLIGO. Seus dados sempre serão tratados de maneira confidencial, e em conformidade com a nova LEI GERAL DE PROTEÇÃO DE DADOS - LGPD. Os psicólogos são capacitados para garantir a segurança da informação, e uso dos dados em toda estrutura. Tudo isso, proporcionando um ambiente de conforto e de muita confiança, além de devidamente aprovados e regularizados junto ao CFP. Você poderá encontrar o selo no rodapé da página.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 5,
                'name'            => 'Vou receber lembretes dos meus agendamentos?',
                'description'     => 'Sim! O paciente e seu respectivo psicólogo receberão um aviso de confirmação por e-mail, constando os detalhes do agendamento assim que a sessão for confirmada.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 6,
                'name'            => 'Qual o valor das consultas?',
                'description'     => 'Os valores das consultas são definidos por você psicólogo, e variam de acordo seus critérios de qualificação. Importante lembrar que pode haver um espaço em sua agenda para realizar o alcance social, ou ainda negociar este atendimento com valores simbólicos, capazes de alcançar a saúde de alguém. Pense nisso!',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 7,
                'name'            => 'Como recebo o pagamento da consulta que realizei?',
                'description'     => 'A CALLIGO conta com um parceiro financeiro que fará o split da transação dividindo imediatamente a transação entre os psicólogos e a Calligo. O tempo de espera para recebimento do seu devido irá variar de acordo com a forma de pagamento, seja PIX ou Cartão de Crédito, e através do seu painel financeiro você irá controlar os seus recebimentos.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 8,
                'name'            => 'Os meus dados bancários estão seguros na Plataforma?',
                'description'     => 'Sim! Utilizamos a criptografia para proteger os dados do seu cartão de crédito. O sistema de pagamento escolhido pela CALLIGO é o mesmo utilizado por grandes corporações e garante segurança em todas as transações financeiras.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 9,
                'name'            => 'Como funcionam as sessões online?',
                'description'     => 'As sessões são realizadas no consultório virtual da CALLIGO, que atende os requisitos HIPAA Compliance e da LGPD, que possuem proteção de dados e sigilo de pacientes. Para acessá-lo não é necessário instalar nenhum aplicativo, você consegue entrar diretamente por um link enviado no seu e-mail 15 minutos antes da sessão, ou também diretamente pela plataforma.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
            [
                'id'              => 10,
                'name'            => 'Posso realizar a sessão através de um celular?',
                'description'     => 'Sim!! Acesse o seu consultório virtual de um computador, tablet ou ainda do celular.',
                'created'         => date('Y-m-d H:m:i'),
                'modified'        => date('Y-m-d H:m:i'),
                'role'            => 3,
                'subject_help_id' => 1
            ],
        ];

        $table = $this->table('helps');
        $table->insert($data)->save();
    }
}
