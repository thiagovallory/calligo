<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Docs seed.
 */
class DocsSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'RecordsSeed',
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
        $faker = Faker\Factory::create('pt_BR');
        $data  = [];
        for ($i = 0; $i < 1485; $i = $i + 3) {
            $data[] = [
                'name'      => $faker->text(255),
                'size'      => 336000,
                'url'       => 'exemplo.pdf',
                'record_id' => $i + 1,
                'created'   => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
                'modified'  => $faker->dateTimeBetween('-11 months', 'now')->format('Y-m-d'),
            ];
        }

        $table = $this->table('docs');
        $table->insert($data)->save();
    }
}
