<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Langs seed.
 */
class LangsSeed extends AbstractSeed
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
            ['id' => 1, 'name' => "Mandarim"],
            ['id' => 2, 'name' => "Espanhol"],
            ['id' => 3, 'name' => "Inglês"],
            ['id' => 4, 'name' => "Bengali"],
            ['id' => 5, 'name' => "Hindi"],
            ['id' => 6, 'name' => "Português"],
            ['id' => 7, 'name' => "Russo"],
            ['id' => 8, 'name' => "Japonês"],
            ['id' => 9, 'name' => "Alemão"],
            ['id' => 10, 'name' => "Chinês"],
            ['id' => 11, 'name' => "Javanês"],
            ['id' => 12, 'name' => "Coreano"],
            ['id' => 13, 'name' => "Francês"],
            ['id' => 14, 'name' => "Vietnamita"],
            ['id' => 15, 'name' => "Telugo"],
            ['id' => 16, 'name' => "Cantonês"],
            ['id' => 17, 'name' => "Marati"],
            ['id' => 18, 'name' => "Tamil"],
            ['id' => 19, 'name' => "Turco"],
            ['id' => 20, 'name' => "Urdu"],
            ['id' => 21, 'name' => "Min nan"],
            ['id' => 22, 'name' => "Jinyu"],
            ['id' => 23, 'name' => "Gujarati"],
            ['id' => 24, 'name' => "Polaco"],
            ['id' => 25, 'name' => "Egípcio"],
            ['id' => 26, 'name' => "Ucraniano"],
            ['id' => 27, 'name' => "Italiano"],
            ['id' => 28, 'name' => "Xiang"],
            ['id' => 29, 'name' => "Malaio"],
            ['id' => 30, 'name' => "Hakka"],
            ['id' => 31, 'name' => "Kannada"],
            ['id' => 32, 'name' => "Oriya"],
            ['id' => 33, 'name' => "Panjabi"],
            ['id' => 34, 'name' => "Sunda"],
            ['id' => 35, 'name' => "Panjabi"],
            ['id' => 36, 'name' => "Romeno"],
            ['id' => 37, 'name' => "Bhojpuri"],
            ['id' => 38, 'name' => "Azerbaijão"],
            ['id' => 39, 'name' => "Farsi"],
            ['id' => 40, 'name' => "Maitili"],
            ['id' => 41, 'name' => "Hauçá"],
            ['id' => 42, 'name' => "Argelino"],
            ['id' => 43, 'name' => "Birmanês"],
            ['id' => 44, 'name' => "Servo-croata"],
            ['id' => 45, 'name' => "Gan"],
            ['id' => 46, 'name' => "Awadhi"],
            ['id' => 47, 'name' => "Tailandês"],
            ['id' => 48, 'name' => "Holandês"],
            ['id' => 49, 'name' => "Iorubá"],
            ['id' => 50, 'name' => "Sindi"],
            ['id' => 51, 'name' => "Libras"],
        ];

        $table = $this->table('langs');
        $table->insert($data)->save();
    }
}
