<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LangsUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LangsUsersTable Test Case
 */
class LangsUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LangsUsersTable
     */
    protected $LangsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LangsUsers',
        'app.Langs',
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
        $config = $this->getTableLocator()->exists('LangsUsers') ? [] : ['className' => LangsUsersTable::class];
        $this->LangsUsers = $this->getTableLocator()->get('LangsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->LangsUsers);

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
