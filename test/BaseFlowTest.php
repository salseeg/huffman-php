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

    /**
     * @param $sample
     * @dataProvider provideStrings
     */
    public function testTreePreservingCoded($sample)
    {

        $data = new DumbString($sample);

        $codec = new TreePreservingCodec();

        $compressed = $codec->encode($data);

        $binString = $compressed->getBitString();

        $pureCompressionRatio = round(strlen($sample) / (strlen($binString) / 8.0), 2);

        print "Compression Ratio = $pureCompressionRatio \n";

        $uncompressed = $codec->decode($compressed);

        $this->assertEquals($sample, $uncompressed->getData());
    }

    /**
     * Provides strings to test
     *
     * @return \Generator
     */
    public function provideStrings()
    {
        yield ['Hello world!!!'];

        foreach(glob(__DIR__.'/_data/*') as $path) {
            print $path . ' ' .implode(' ', str_split(filesize($path), 3)). PHP_EOL;
            yield [file_get_contents($path)];
        }
    }




}
