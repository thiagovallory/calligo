<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewsTable Test Case
 */
class ReviewsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewsTable
     */
    protected $Reviews;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Reviews',
        'app.Products',
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
        $config = $this->getTableLocator()->exists('Reviews') ? [] : ['className' => ReviewsTable::class];
        $this->Reviews = $this->getTableLocator()->get('Reviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Reviews);

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
