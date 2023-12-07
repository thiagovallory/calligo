<?php
declare(strict_types=1);

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * User seed.
 */
class UserSeed extends AbstractSeed
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
        $hasher = new DefaultPasswordHasher();
        $faker  = Faker\Factory::create('pt_BR');
        $data   = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'username'    => $faker->email,
                'password'    => $hasher->hash('123456'),
                'name'        => $faker->firstName . ' ' . $faker->lastName,
                'role'        => 2,
                'active'      => 1,
                'first_login' => 0,
                'to_remove'   => 0,
                'created'     => date('Y-m-d H:i:s'),
                'modified'    => date('Y-m-d H:i:s'),
                'hash_active' => $faker->randomAscii,
            ];
        }
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'username'    => $faker->email,
                'password'    => $hasher->hash('123456'),
                'name'        => $faker->firstName . ' ' . $faker->lastName,
                'role'        => 1,
                'active'      => 1,
                'first_login' => 0,
                'to_remove'   => 0,
                'created'     => date('Y-m-d H:i:s'),
                'modified'    => date('Y-m-d H:i:s'),
                'hash_active' => $faker->randomAscii,
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
