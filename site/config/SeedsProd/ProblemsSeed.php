<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Problems seed.
 */
class ProblemsSeed extends AbstractSeed
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
                "name" => "Adicção (drogas)"
            ],
            [
                "name" => "Adicção (Internet)"
            ],
            [
                "name" => "Adicção (Jogos de azar)"
            ],
            [
                "name" => "Adicção (sexo)"
            ],
            [
                "name" => "Adicção (Video game)"
            ],
            [
                "name" => "TDAH"
            ],
            [
                "name" => "Adoção"
            ],
            [
                "name" => "Alcoolismo"
            ],
            [
                "name" => "Abuso de drogas"
            ],
            [
                "name" => "Alzheimer"
            ],
            [
                "name" => "Ansiedade"
            ],
            [
                "name" => "Ansiedade Generalizada"
            ],
            [
                "name" => "Autismo"
            ],
            [
                "name" => "Aconselhamento de carreira"
            ],
            [
                "name" => "Manejo da raiva"
            ],
            [
                "name" => "Personalidade anti-social"
            ],
            [
                "name" => "Síndrome de Asperger"
            ],
            [
                "name" => "Questões Comportamentais"
            ],
            [
                "name" => "Desordem Bipolar"
            ],
            [
                "name" => "Personalidade Borderline"
            ],
            [
                "name" => "Sexualidade"
            ],
            [
                "name" => "Criança ou Adolescente"
            ],
            [
                "name" => "Doença Crônica"
            ],
            [
                "name" => "Impulsividade Crônica"
            ],
            [
                "name" => "Dor Crônica"
            ],
            [
                "name" => "Codependência"
            ],
            [
                "name" => "Habilidades de coping/enfrentamento"
            ],
            [
                "name" => "Depressão"
            ],
            [
                "name" => "Distúrbios de desenvolvimento"
            ],
            [
                "name" => "Divórcio"
            ],
            [
                "name" => "Abuso doméstico"
            ],
            [
                "name" => "Violência doméstica"
            ],
            [
                "name" => "Diagnóstico co-ocorrente (adição de substâncias e outra saúde mental)"
            ],
            [
                "name" => "Distúrbios Alimentares"
            ],
            [
                "name" => "Perturbação Emocional"
            ],
            [
                "name" => "Conflito familiar"
            ],
            [
                "name" => "Jogos de azar"
            ],
            [
                "name" => "Luto"
            ],
            [
                "name" => "Hoarding"
            ],
            [
                "name" => "Infertilidade"
            ],
            [
                "name" => "Infidelidade"
            ],
            [
                "name" => "Deficiência intelectual"
            ],
            [
                "name" => "Vício da Internet"
            ],
            [
                "name" => "Dificuldades de Aprendizagem"
            ],
            [
                "name" => "Coaching de vida"
            ],
            [
                "name" => "Transições de Vida"
            ],
            [
                "name" => "Matrimonial e Pré-conjugal"
            ],
            [
                "name" => "Desintoxicação"
            ],
            [
                "name" => "Gestão de Medicamentos"
            ],
            [
                "name" => "Questões de homens"
            ],
            [
                "name" => "Personalidade Narcisista"
            ],
            [
                "name" => "Obesidade"
            ],
            [
                "name" => "Obsessivo-Compulsivo (OCD)"
            ],
            [
                "name" => "Desafío Opositivo"
            ],
            [
                "name" => "Paternidade/Maternidade"
            ],
            [
                "name" => "Relacionamentos entre colegas"
            ],
            [
                "name" => "Perfeccionismo"
            ],
            [
                "name" => "Gravidez, Pré-natal, Pós-parto"
            ],
            [
                "name" => "Identidade Racial"
            ],
            [
                "name" => "Questões de Relacionamento"
            ],
            [
                "name" => "Questões escolares"
            ],
            [
                "name" => "Auto-Aquecimento"
            ],
            [
                "name" => "Auto-estima"
            ],
            [
                "name" => "Terapia Sexual"
            ],
            [
                "name" => "Abuso Sexual"
            ],
            [
                "name" => "Vício Sexual"
            ],
            [
                "name" => "Sono ou insônia"
            ],
            [
                "name" => "Espiritualidade"
            ],
            [
                "name" => "Desempenho desportivo"
            ],
            [
                "name" => "Estresse"
            ],
            [
                "name" => "Utilização da substância"
            ],
            [
                "name" => "Ideação Suicida"
            ],
            [
                "name" => "Violência juvenil"
            ],
            [
                "name" => "Teste e Avaliação"
            ],
            [
                "name" => "Transgênero"
            ],
            [
                "name" => "Trauma e TEPT (transtorno de estresse pós traumático)"
            ],
            [
                "name" => "Lesão Cerebral Traumática"
            ],
            [
                "name" => "Vício em Videogames"
            ],
            [
                "name" => "Perda de peso"
            ],
            [
                "name" => "Questões da mulher"
            ],
            [
                "name" => "Saúde Mental"
            ],
            [
                "name" => "Distúrbios dissociativos"
            ],
            [
                "name" => "Desordens dos Idosos"
            ],
            [
                "name" => "Distúrbios de Controlo de Impulsos"
            ],
            [
                "name" => "Perturbações do humor"
            ],
            [
                "name" => "Transtornos de personalidade"
            ],
            [
                "name" => "Psicose"
            ],
            [
                "name" => "Distúrbios do Pensamento"
            ],
            [
                "name" => "Outros assuntos"
            ]
        ];

        $table = $this->table('problems');
        $table->insert($data)->save();
    }
}
