<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FollowTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FollowTable Test Case
 */
class FollowTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FollowTable
     */
    public $Follow;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Follow',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Follow') ? [] : ['className' => FollowTable::class];
        $this->Follow = TableRegistry::getTableLocator()->get('Follow', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Follow);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
