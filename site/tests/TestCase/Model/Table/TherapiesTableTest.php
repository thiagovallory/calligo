<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TherapiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TherapiesTable Test Case
 */
class TherapiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TherapiesTable
     */
    protected $Therapies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Therapies') ? [] : ['className' => TherapiesTable::class];
        $this->Therapies = $this->getTableLocator()->get('Therapies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Therapies);

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
}
