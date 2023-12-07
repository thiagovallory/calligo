<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcceptedModalitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcceptedModalitiesTable Test Case
 */
class AcceptedModalitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcceptedModalitiesTable
     */
    protected $AcceptedModalities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AcceptedModalities',
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
        $config = $this->getTableLocator()->exists('AcceptedModalities') ? [] : ['className' => AcceptedModalitiesTable::class];
        $this->AcceptedModalities = $this->getTableLocator()->get('AcceptedModalities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AcceptedModalities);

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
