<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FinancialInstitutionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FinancialInstitutionsTable Test Case
 */
class FinancialInstitutionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FinancialInstitutionsTable
     */
    protected $FinancialInstitutions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.FinancialInstitutions',
        'app.Banks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FinancialInstitutions') ? [] : ['className' => FinancialInstitutionsTable::class];
        $this->FinancialInstitutions = $this->getTableLocator()->get('FinancialInstitutions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->FinancialInstitutions);

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
