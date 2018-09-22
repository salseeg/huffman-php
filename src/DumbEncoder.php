<?php
namespace Serge\HuffmanPhp;


use Serge\HuffmanPhp\Contracts\Decodable;
use Serge\HuffmanPhp\Contracts\Encodable;
use Serge\HuffmanPhp\Contracts\Encoder;
use Serge\HuffmanPhp\DataWrappers\DumbString;

class DumbEncoder implements Encoder
{
    /**
     * Encodes some data
     * @param Encodable $toEncode
     * @return Decodable
     */
    public function encode(Encodable $toEncode): Decodable
    {
        return new DumbString($toEncode->getData());
    }
}