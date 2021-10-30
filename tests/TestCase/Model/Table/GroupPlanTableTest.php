<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GroupPlanTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupPlanTable Test Case
 */
class GroupPlanTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GroupPlanTable
     */
    public $GroupPlan;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.GroupPlan'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GroupPlan') ? [] : ['className' => GroupPlanTable::class];
        $this->GroupPlan = TableRegistry::getTableLocator()->get('GroupPlan', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GroupPlan);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
