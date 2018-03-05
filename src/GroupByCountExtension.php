<?php

namespace gorriecoe\GroupByCount;

use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\DataExtension;

/**
 * GroupByCountExtension
 *
 * @package silverstripe-groupbycount
 */
class GroupByCountExtension extends DataExtension
{
    protected $loopCharacters = '__';

    /**
     * @param int $groupcount group count
     * @param int|string,... $groupcount Additional group counts
     * @return ArrayList
     */
    public function GroupByCount()
    {
        $owner = $this->owner;

        // Defines the number of items in each group
        $arguments = func_get_args();
        $lastArgument = end($arguments);
        $totalItems = $owner->Count();
        $argumentsCount = count($arguments);
        $totalGroups = (int) ceil(($totalItems / array_sum($arguments)) * $argumentsCount);
        $groupCounts = [];

        if ($this->isLooper($lastArgument)) {
            $lastCount = 1;
            $loopLast = false;

            for ($i = 0; $i < $totalGroups; $i++) {
                if ($loopLast) {
                    $groupCounts[] = (int) $lastCount;
                } else {
                    $value = $arguments[$i];

                    if ($count = $this->isLooper($value)) {
                        $lastCount = $count;
                        $loopLast = true;
                        $groupCounts[] = (int) $lastCount;
                    } else {
                        $lastCount = $value;
                        $groupCounts[] = (int) $value;
                    }
                }

            }
        } else {
            $pos = 0;
            $argumentsLastIndex = $argumentsCount - 1;
            for ($i = 0; $i < $totalGroups; $i++) {
                $groupCounts = array_merge($groupCounts, $arguments);
            }
        }

        $list = $owner->toArray();
        $groupedList = ArrayList::create();
        foreach ($groupCounts as $key => $itemCount) {
            $items = array_slice($list, 0, $itemCount);

            if (!count($items)) {
                break;
            }

            $groupedList->push(
                ArrayData::create(
                    array(
                        'Items' => ArrayList::create($items),
                        'MaxCount' => $itemCount
                    )
                )
            );
            // Remove items from old list
            $list = array_slice($list, $itemCount, count($list));
        }

        return $groupedList;
    }

    public function isLooper($string)
    {
        if (substr($string, -strlen($this->loopCharacters)) == '__') {
            return rtrim($string, '__');
        };
    }

}
