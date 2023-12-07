<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BondsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BondsTable Test Case
 */
class BondsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BondsTable
     */
    protected $Bonds;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Bonds',
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
        $config      = $this->getTableLocator()->exists('Bonds') ? [] : ['className' => BondsTable::class];
        $this->Bonds = $this->getTableLocator()->get('Bonds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Bonds);

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
