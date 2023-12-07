<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * AgesUsers seed.
 */
class AgesUsersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
            'AgesSeed',
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
                'age_id'  => rand(1, 12),
                'user_id' => $i
            ];
        }
        $table = $this->table('ages_users');
        $table->insert($data)->save();
    }
}
