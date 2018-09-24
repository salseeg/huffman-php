<?php
namespace Serge\HuffmanPhp\Tests;

use PHPUnit\Framework\TestCase;
use Serge\HuffmanPhp\DataWrappers\DumbString;
use Serge\HuffmanPhp\DumbDecoder;
use Serge\HuffmanPhp\DumbEncoder;
use Serge\HuffmanPhp\TreePreservingCodec;

class BaseFlowTest extends TestCase
{
    public function testFlow()
    {
        $sample = 'testing how would we compress it';

        $data = new DumbString($sample);
        $encoder = new DumbEncoder();
        $decoder = new DumbDecoder();
        
        $this->assertEquals($sample, $data->getData());
        
        $compressed = $encoder->encode($data);
        $uncompressed = $decoder->decode($compressed);
        
        $this->assertEquals($sample, $uncompressed->getData());
    }

    public function testTreePreservingCoded()
    {
        $sample = 'Hello world!!!';

        $data = new DumbString($sample);

        $codec = new TreePreservingCodec();

        $compressed = $codec->encode($data);

        $binString = $compressed->getRawData();

        $pureCompressionRatio = round(strlen($sample) / (strlen($binString) / 8.0), 2);

        print "Compression Ratio = $pureCompressionRatio \n";

        $uncompressed = $codec->decode($compressed);

        $this->assertEquals($sample, $uncompressed->getData());
    }


}
