<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModalitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModalitiesTable Test Case
 */
class ModalitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ModalitiesTable
     */
    protected $Modalities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Modalities',
        'app.Costs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Modalities') ? [] : ['className' => ModalitiesTable::class];
        $this->Modalities = $this->getTableLocator()->get('Modalities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Modalities);

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
