<?php
namespace Serge\HuffmanPhp\DataWrappers;

use Serge\HuffmanPhp\Contracts\Decodable;
use Serge\HuffmanPhp\Contracts\Encodable;

class DumbString implements Encodable, Decodable
{
    /** @var string  */
    protected $str = '';

    /**
     * DumbString constructor.
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * @return string
     */
    public function getBitString(): string
    {
        return $this->str;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->str;
    }
}