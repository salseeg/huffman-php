<?php
namespace Serge\HuffmanPhp\Tree;


class Node
{
    /** @var string  */
    protected $char = '';

    /** @var Node|null  */
    protected $left = null;

    /** @var Node|null  */
    protected $right = null;

    /**
     * Node constructor.
     * @param string $char
     * @param ?Node $left
     * @param ?Node $right
     */
    public function __construct(string $char, $left = null, $right = null)
    {
        $this->char = $char;
        $this->left = $left;
        $this->right = $right;
    }

    public function __toString()
    {
        if ($this->char) {
            return $this->char;
        }

        return "[{$this->left}-{$this->right}]";
    }

    public function getPath(string $char): ?string
    {
        if ($char == $this->char) {
            return '';
        }

        if ($this->left) {
            $path = $this->left->getPath($char);

            if ($path !== null) {
                return '0' . $path;
            }
        }

        if ($this->right) {
            $path = $this->right->getPath($char);

            if ($path !== null) {
                return '1' . $path;
            }
        }

        return null;
    }


}