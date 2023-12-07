<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * LangsUsers seed.
 */
class LangsUsersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeed',
            'LangSeed',
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
                'lang_id' => rand(1, 51),
                'user_id' => $i
            ];
        }

        $table = $this->table('langs_users');
        $table->insert($data)->save();
    }
}
