<?php

namespace Serge\HuffmanPhp\Contracts;

/**
 * Interface Decodable
 * @package Serge\HuffmanPhp\Contracts
 */
interface Decodable
{
    /**
     * Get data to be decoded
     *
     * @return string
     */
    public function getBitString(): string;
}