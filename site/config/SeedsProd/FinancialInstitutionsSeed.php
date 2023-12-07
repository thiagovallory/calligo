<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * FinancialInstitutions seed.
 */
class FinancialInstitutionsSeed extends AbstractSeed
{
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
                'id'   => '001',
                'name' => 'Banco do Brasil'
            ],
            [
                'id'   => '033',
                'name' => 'Santander'
            ],
            [
                'id'   => '104',
                'name' => 'Caixa Econômica'
            ],
            [
                'id'   => '237',
                'name' => 'Bradesco'
            ],
            [
                'id'   => '341',
                'name' => 'Itaú'
            ],
            [
                'id'   => '041',
                'name' => 'Banrisul'
            ],
            [
                'id'   => '748',
                'name' => 'Sicredi'
            ],
            [
                'id'   => '756',
                'name' => 'Sicoob'
            ],
            [
                'id'   => '077',
                'name' => 'Inter'
            ],
            [
                'id'   => '070',
                'name' => 'BRB'
            ],
            [
                'id'   => '085',
                'name' => 'Via Credi'
            ],
            [
                'id'   => '655',
                'name' => 'Neon/Votorantim'
            ],
            [
                'id'   => '260',
                'name' => 'Nubank'
            ],
            [
                'id'   => '290',
                'name' => 'Pagseguro'
            ],
            [
                'id'   => '212',
                'name' => 'Banco Original'
            ],
            [
                'id'   => '422',
                'name' => 'Safra'
            ],
            [
                'id'   => '746',
                'name' => 'Modal'
            ],
            [
                'id'   => '021',
                'name' => 'Banestes'
            ],
            [
                'id'   => '136',
                'name' => 'Unicred'
            ],
            [
                'id'   => '274',
                'name' => 'Money Plus'
            ],
            [
                'id'   => '389',
                'name' => 'Mercantil do Brasil'
            ],
            [
                'id'   => '376',
                'name' => 'JP Morgan'
            ],
            [
                'id'   => '364',
                'name' => 'Gerencianet Pagamentos do Brasil'
            ],
            [
                'id'   => '336',
                'name' => 'Banco C6'
            ],
            [
                'id'   => '218',
                'name' => 'BS2'
            ],
            [
                'id'   => '082',
                'name' => 'Banco Topazio'
            ],
            [
                'id'   => '099',
                'name' => 'Uniprime'
            ],
            [
                'id'   => '197',
                'name' => 'Stone'
            ],
            [
                'id'   => '707',
                'name' => 'Banco Daycoval'
            ],
            [
                'id'   => '633',
                'name' => 'Rendimento'
            ],
            [
                'id'   => '004',
                'name' => 'Banco do Nordeste'
            ],
            [
                'id'   => '745',
                'name' => 'Citibank'
            ],
            [
                'id'   => '301',
                'name' => 'PJBank'
            ],
            [
                'id'   => '97',
                'name' => 'Cooperativa Central de Credito Noroeste Brasileiro'
            ],
            [
                'id'   => '084',
                'name' => 'Uniprime Norte do Paraná'
            ],
            [
                'id'   => '384',
                'name' => 'Global SCM'
            ],
            [
                'id'   => '403',
                'name' => 'Cora'
            ],
            [
                'id'   => '323',
                'name' => 'Mercado Pago'
            ],
            [
                'id'   => '003',
                'name' => 'Banco da Amazonia'
            ],
            [
                'id'   => '752',
                'name' => 'BNP Paribas Brasil'
            ],
            [
                'id'   => '383',
                'name' => 'Juno'
            ],
            [
                'id'   => '133',
                'name' => 'Cresol'
            ],
            [
                'id'   => '173',
                'name' => 'BRL Trust DTVM'
            ],
            [
                'id'   => '047',
                'name' => 'Banco Banese'
            ],
            [
                'id'   => '208',
                'name' => 'Banco BTG Pactual'
            ],
            [
                'id'   => '613',
                'name' => 'Banco Omni'
            ],
            [
                'id'   => '332',
                'name' => 'Acesso Soluções de Pagamento'
            ],
            [
                'id'   => '273',
                'name' => 'CCR de São Miguel do Oeste'
            ],
            [
                'id'   => '093',
                'name' => 'Polocred'
            ],
            [
                'id'   => '355',
                'name' => 'Ótimo'
            ],
            [
                'id'   => '121',
                'name' => 'Agibank'
            ],
            [
                'id'   => '037',
                'name' => 'Banpará'
            ],
            [
                'id'   => '380',
                'name' => 'Picpay'
            ],
            [
                'id'   => '125',
                'name' => 'Banco Genial'
            ],

            [
                'id'   => '412',
                'name' => 'Banco Capital S.A'
            ],

            [
                'id'   => '741',
                'name' => 'Banco Ribeirão Preto'
            ],
            [
                'id'   => '461',
                'name' => 'ASAAS IP'
            ],
            [
                'id'   => '623',
                'name' => 'Banco Pan'
            ],
            [
                'id'   => '735',
                'name' => 'Neon'
            ],
            [
                'id'   => '310',
                'name' => 'VORTX DTVM LTDA'
            ],
            [
                'id'   => '318',
                'name' => 'Banco BMG'
            ],
            [
                'id'   => '450',
                'name' => 'Fitbank'
            ]
        ];

        $table = $this->table('financial_institutions');
        $table->insert($data)->save();
    }
}
