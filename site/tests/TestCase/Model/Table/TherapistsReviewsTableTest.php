<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TherapistsReviewsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TherapistsReviewsTable Test Case
 */
class TherapistsReviewsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TherapistsReviewsTable
     */
    protected $TherapistsReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TherapistsReviews',
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
        $config = $this->getTableLocator()->exists('TherapistsReviews') ? [] : ['className' => TherapistsReviewsTable::class];
        $this->TherapistsReviews = $this->getTableLocator()->get('TherapistsReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TherapistsReviews);

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
