<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialtiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialtiesTable Test Case
 */
class SpecialtiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpecialtiesTable
     */
    protected $Specialties;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Specialties') ? [] : ['className' => SpecialtiesTable::class];
        $this->Specialties = $this->getTableLocator()->get('Specialties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Specialties);

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
