<?php
namespace extas\components\plugins\repositories;

use extas\components\plugins\Plugin;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\IHasSample;

/**
 * Class PluginFieldSampleName
 *
 * @package extas\components\plugins\repositories
 * @author jeyroik <jeyroik@gmail.com>
 */
class PluginFieldSampleName extends Plugin
{
    /**
     * @param IItem $item
     */
    public function __invoke(IItem &$item)
    {
        if (($item instanceof IHasName) && ($item instanceof IHasSample)) {
            $name = $item->getName();
            if (!empty($name)) {
                preg_match('/@sample\((.*)\)/', $name, $match);
                if (isset($match[0])) {
                    $suffix = '';
                    if (!empty($match[1])) {
                        $item->setName('@' . $match[1]);
                        $this->additionalOperating($item);
                        $suffix = ('@' . $match[1] == $item->getName()) ? '_' . $match[1] : '_' . $item->getName();
                    }
                    $item->setName($item->getSampleName() . $suffix);
                }
            } else {
                $item->setName($item->getSampleName());
            }
        }
    }

    /**
     * @param $item
     */
    protected function additionalOperating(&$item)
    {
        $others = [
            PluginFieldUuid::class,
            PluginFieldSha1::class
        ];

        foreach ($others as $other) {
            $plugin = new $other();
            $plugin($item);
        }
    }
}
