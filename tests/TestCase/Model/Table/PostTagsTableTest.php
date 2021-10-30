<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostTagsTable Test Case
 */
class PostTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostTagsTable
     */
    public $PostTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostTags',
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
        $config = TableRegistry::getTableLocator()->exists('PostTags') ? [] : ['className' => PostTagsTable::class];
        $this->PostTags = TableRegistry::getTableLocator()->get('PostTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostTags);

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
