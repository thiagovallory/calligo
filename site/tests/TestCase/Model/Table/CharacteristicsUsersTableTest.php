<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharacteristicsUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CharacteristicsUsersTable Test Case
 */
class CharacteristicsUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CharacteristicsUsersTable
     */
    protected $CharacteristicsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CharacteristicsUsers',
        'app.Users',
        'app.Characteristics',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CharacteristicsUsers') ? [] : ['className' => CharacteristicsUsersTable::class];
        $this->CharacteristicsUsers = $this->getTableLocator()->get('CharacteristicsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CharacteristicsUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
