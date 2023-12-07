<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialtiesUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialtiesUsersTable Test Case
 */
class SpecialtiesUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpecialtiesUsersTable
     */
    protected $SpecialtiesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SpecialtiesUsers',
        'app.Specialties',
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
        $config = $this->getTableLocator()->exists('SpecialtiesUsers') ? [] : ['className' => SpecialtiesUsersTable::class];
        $this->SpecialtiesUsers = $this->getTableLocator()->get('SpecialtiesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SpecialtiesUsers);

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
