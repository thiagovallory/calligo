<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeOfDocumentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeOfDocumentsTable Test Case
 */
class TypeOfDocumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeOfDocumentsTable
     */
    protected $TypeOfDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TypeOfDocuments',
        'app.Docs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TypeOfDocuments') ? [] : ['className' => TypeOfDocumentsTable::class];
        $this->TypeOfDocuments = $this->getTableLocator()->get('TypeOfDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TypeOfDocuments);

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
