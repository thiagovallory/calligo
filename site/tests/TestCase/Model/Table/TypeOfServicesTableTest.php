<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeOfServicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeOfServicesTable Test Case
 */
class TypeOfServicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeOfServicesTable
     */
    protected $TypeOfServices;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TypeOfServices',
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
        $config = $this->getTableLocator()->exists('TypeOfServices') ? [] : ['className' => TypeOfServicesTable::class];
        $this->TypeOfServices = $this->getTableLocator()->get('TypeOfServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TypeOfServices);

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
