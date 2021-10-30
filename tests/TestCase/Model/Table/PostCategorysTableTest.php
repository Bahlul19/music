<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostCategorysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostCategorysTable Test Case
 */
class PostCategorysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostCategorysTable
     */
    public $PostCategorys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostCategorys',
        'app.Posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostCategorys') ? [] : ['className' => PostCategorysTable::class];
        $this->PostCategorys = TableRegistry::getTableLocator()->get('PostCategorys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostCategorys);

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
