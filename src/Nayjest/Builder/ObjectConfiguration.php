<?php
namespace Nayjest\Builder;


class ObjectConfiguration extends Configuration
{
    const OPTION_PREFIX = '@';

    protected $metaOptions = [];

    public function getMeta($key, $default = null)
    {
        if (isset($this->metaOptions[$key])) {
            return $this->metaOptions[$key];
        } else {
            $val = $this->extract(static::OPTION_PREFIX . $key);
            if ($val === null) {
                return $default;
            } else {
                return $this->metaOptions[$key] = $val;
            }
        }
    }

    public function setMeta($key, $value)
    {
        $this->metaOptions[$key] = $value;
    }

} 