<?php
namespace Serge\HuffmanPhp\Contracts;

/**
 * Interface Encodable
 * @package Serge\HuffmanPhp\Contracts
 */
interface Encodable
{
    /**
     * Gets data to encode
     *
     * @return string
     */
    public function getData(): string;
}