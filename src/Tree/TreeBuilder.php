<?php

namespace Serge\HuffmanPhp\Tree;


class TreeBuilder
{
    public static function build(array $dictionary, int $total): ?Node
    {
        $count = count($dictionary);

        if ($count < 1) {
            return null;
        }

        $firstKey = array_keys($dictionary)[0];

        if ($count < 2) {
            return new Node($firstKey);
        }


        $leftTotal = $dictionary[$firstKey];
        $leftDict = [
            $firstKey => $leftTotal
        ];
        unset($dictionary[$firstKey]);

        foreach ($dictionary as $char => $hits) {
            if ($total / 2 < $leftTotal + $hits) {
                break;
            }

            $leftDict[$char] = $hits;
            $leftTotal += $hits;

            unset($dictionary[$char]);
        }

        return new Node(
            '',
            TreeBuilder::build($leftDict, $leftTotal),
            TreeBuilder::build($dictionary, $total - $leftTotal)
        );
    }

    public static function countDictTotal(array $dictionary): int
    {
        $total = 0;

        foreach ($dictionary as $count) {
            $total += $count;
        }

        return $total;
    }
}