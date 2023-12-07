<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * CharacteristicsUsers seed.
 */
class CharacteristicsUsersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'CharacteristicsSeed',
            'UserSeed',
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
                'user_id'            => $i,
                'characteristic_id' => rand(1, 10)
            ];
        }

        $table = $this->table('characteristics_users');
        $table->insert($data)->save();
    }
}
