<?php
namespace Serge\HuffmanPhp\Tests;

use PHPUnit\Framework\TestCase;
use Serge\HuffmanPhp\DataWrappers\DumbString;
use Serge\HuffmanPhp\DumbDecoder;
use Serge\HuffmanPhp\DumbEncoder;

class BaseFlowTest extends TestCase
{
    public function testFlow()
    {
        $sample = 'test';
        $data = new DumbString($sample);
        
        $encoder = new DumbEncoder();
        $decoder = new DumbDecoder();
        
        $this->assertEquals($sample, $data->getData());
        
        $compressed = $encoder->encode($data);
        $uncompressed = $decoder->decode($compressed);
        
        $this->assertEquals($sample, $uncompressed->getData());
    }
}
