<?php
namespace Serge\HuffmanPhp\Contracts;

interface Encoder
{
    /**
     * Encodes some data
     * @param Encodable $toEncode
     * @return Decodable
     */
    public function encode(Encodable $toEncode): Decodable;
}