<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediaCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediaCommentsTable Test Case
 */
class MediaCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MediaCommentsTable
     */
    public $MediaComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MediaComments',
        'app.Media',
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
        $config = TableRegistry::getTableLocator()->exists('MediaComments') ? [] : ['className' => MediaCommentsTable::class];
        $this->MediaComments = TableRegistry::getTableLocator()->get('MediaComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MediaComments);

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
