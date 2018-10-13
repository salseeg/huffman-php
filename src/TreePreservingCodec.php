<?php
namespace Serge\HuffmanPhp;

use Serge\HuffmanPhp\Contracts\Decodable;
use Serge\HuffmanPhp\Contracts\Decoder;
use Serge\HuffmanPhp\Contracts\Encodable;
use Serge\HuffmanPhp\Contracts\Encoder;
use Serge\HuffmanPhp\DataWrappers\DumbString;
use Serge\HuffmanPhp\Tree\Node;
use Serge\HuffmanPhp\Tree\TreeBuilder;

class TreePreservingCodec implements Decoder, Encoder
{
    /** @var null|Node  */
    protected $tree = null;

    /** @var array */
    protected $codeDictionary = [];

    /**
     * decodes encoded data
     *
     * @param Decodable $encoded
     * @return Encodable
     */
    public function decode(Decodable $encoded): Encodable
    {
        $bitString = $encoded->getBitString();

        $reverseDict = array_combine(array_values($this->codeDictionary), array_keys($this->codeDictionary));

        $decoded = '';
        $codeLength = 1;
        while ($len = strlen($bitString) and $len >= $codeLength) {
            $code = substr($bitString,0, $codeLength);

            if (array_key_exists($code, $reverseDict)) {
                $decoded .= $reverseDict[$code];
                $bitString = substr($bitString, $codeLength);
                $codeLength = 1;
            } else {
                $codeLength += 1;
            }
        }

        return new DumbString($decoded);

    }

    /**
     * Encodes some data
     * @param Encodable $toEncode
     * @return Decodable
     */
    public function encode(Encodable $toEncode): Decodable
    {
        $str = $toEncode->getData();

        $this->makeCodeDictionary($str);

        return new DumbString($this->encodeString($str));
    }

    protected function makeCodeDictionary(string $str)
    {
        $dict = [];
        $chars = str_split($str);
        foreach ($chars as $char) {
            if (array_key_exists($char, $dict)) {
                $dict[$char] += 1;
            } else {
                $dict[$char] = 1;
            }
        }

        $this->tree = TreeBuilder::build($dict, count($chars));

        $this->codeDictionary = [];
        foreach ($dict as $char => $v) {
            $this->codeDictionary[$char] = $this->tree->getPath($char);
        }
    }

    protected function encodeString($str): string
    {
        $result = '';
        foreach (str_split($str) as $char) {
            $result .= $this->codeDictionary[$char];
        }

        return $result;
    }
}