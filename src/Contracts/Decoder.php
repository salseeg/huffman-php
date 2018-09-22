<?php
namespace Serge\HuffmanPhp\Contracts;

/**
 * Interface Decoder
 * @package Serge\HuffmanPhp\Contracts
 */
interface Decoder
{
    /**
     * decodes encoded data
     *
     * @param Decodable $encoded
     * @return Encodable
     */
    public function decode(Decodable $encoded): Encodable;
}