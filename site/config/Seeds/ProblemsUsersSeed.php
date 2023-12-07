<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * ProblemsUsers seed.
 */
class ProblemsUsersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'ProblemsSeed',
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
                'problem_id' => rand(1, 88),
                'user_id'    => $i
            ];
        }

        $table = $this->table('problems_users');
        $table->insert($data)->save();
    }
}
