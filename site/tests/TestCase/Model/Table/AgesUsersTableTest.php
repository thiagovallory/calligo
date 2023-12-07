<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgesUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgesUsersTable Test Case
 */
class AgesUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AgesUsersTable
     */
    protected $AgesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AgesUsers',
        'app.Ages',
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
        $config = $this->getTableLocator()->exists('AgesUsers') ? [] : ['className' => AgesUsersTable::class];
        $this->AgesUsers = $this->getTableLocator()->get('AgesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AgesUsers);

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
