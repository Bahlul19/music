<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediaMetasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediaMetasTable Test Case
 */
class MediaMetasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MediaMetasTable
     */
    public $MediaMetas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MediaMetas',
        'app.Media',
        'app.CartItems'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MediaMetas') ? [] : ['className' => MediaMetasTable::class];
        $this->MediaMetas = TableRegistry::getTableLocator()->get('MediaMetas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MediaMetas);

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
