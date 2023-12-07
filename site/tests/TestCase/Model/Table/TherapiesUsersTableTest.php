<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TherapiesUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TherapiesUsersTable Test Case
 */
class TherapiesUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TherapiesUsersTable
     */
    protected $TherapiesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TherapiesUsers',
        'app.Therapies',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TherapiesUsers') ? [] : ['className' => TherapiesUsersTable::class];
        $this->TherapiesUsers = $this->getTableLocator()->get('TherapiesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TherapiesUsers);

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
