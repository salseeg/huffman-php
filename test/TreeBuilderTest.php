<?php
namespace Serge\HuffmanPhp\Tests;

use PHPUnit\Framework\TestCase;
use Serge\HuffmanPhp\Tree\TreeBuilder;

class TreeBuilderTest extends TestCase
{
    /**
     * Checking tree building
     */
    public function testBasic()
    {
        $dict = [
            'a' => 4,
            'b' => 3,
            'c' => 1,
            'd' => 1,
            'e' => 1,
            'f' => 1,
            'g' => 1,
            'h' => 1,
        ];

        $tree = TreeBuilder::build(
            $dict,
            TreeBuilder::countDictTotal($dict)
        );
        $this->assertNotNull($tree);

        if (! $tree) {
            $this->fail();
        }

        $this->assertEquals('[a-[[b-c]-[[d-e]-[f-[g-h]]]]]', (string) $tree);

        $this->assertEquals(8, count($dict));
        foreach ($dict as $char => $value) {
            $dict[$char] = $tree->getPath($char);
        }

        $this->assertEquals('100', $dict['b']);
        $this->assertEquals('0', $dict['a']);
    }

    /**
     * Checking that sum calculated correctly
     */
    public function testTotalCount()
    {
        $this->assertEquals(4, TreeBuilder::countDictTotal([
            'a' => 1,
            'b' => 1,
            'c' => 2,
        ]));
    }
}