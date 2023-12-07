<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModalitiesHasUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModalitiesHasUsersTable Test Case
 */
class ModalitiesHasUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ModalitiesHasUsersTable
     */
    protected $ModalitiesHasUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ModalitiesHasUsers',
        'app.Modalities',
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
        $config = $this->getTableLocator()->exists('ModalitiesHasUsers') ? [] : ['className' => ModalitiesHasUsersTable::class];
        $this->ModalitiesHasUsers = $this->getTableLocator()->get('ModalitiesHasUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ModalitiesHasUsers);

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
