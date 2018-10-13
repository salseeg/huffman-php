<?php
namespace Serge\HuffmanPhp;

use Serge\HuffmanPhp\Contracts\Decodable;
use Serge\HuffmanPhp\Contracts\Decoder;
use Serge\HuffmanPhp\Contracts\Encodable;
use Serge\HuffmanPhp\DataWrappers\DumbString;

class DumbDecoder implements Decoder
{

    /**
     * decodes encoded data
     *
     * @param Decodable $encoded
     * @return Encodable
     */
    public function decode(Decodable $encoded): Encodable
    {
        return new DumbString($encoded->getBitString());
    }
}