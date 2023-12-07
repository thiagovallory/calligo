<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * SpecialtiesUsers seed.
 */
class SpecialtiesUsersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
            'SpecialtiesSeed'
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
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'specialty_id' => rand(1, 9),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(10, 19),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(20, 29),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(30, 39),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(40, 49),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(50, 59),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(60, 69),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(70, 79),
                'user_id'      => $i
            ];
            $data[] = [
                'specialty_id' => rand(80, 88),
                'user_id'      => $i
            ];
        }

        $table = $this->table('specialties_users');
        $table->insert($data)->save();
    }
}
