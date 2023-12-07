<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HelpsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HelpsTable Test Case
 */
class HelpsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HelpsTable
     */
    protected $Helps;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Helps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Helps') ? [] : ['className' => HelpsTable::class];
        $this->Helps = $this->getTableLocator()->get('Helps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Helps);

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
