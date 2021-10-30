<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GenreTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GenreTable Test Case
 */
class GenreTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GenreTable
     */
    public $Genre;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Genre'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Genre') ? [] : ['className' => GenreTable::class];
        $this->Genre = TableRegistry::getTableLocator()->get('Genre', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Genre);

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
