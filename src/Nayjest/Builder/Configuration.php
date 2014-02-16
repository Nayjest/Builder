<?php
namespace Nayjest\Builder;

class Configuration
{
    protected $src;

    public function __construct(array $src)
    {
        $this->src = $src;
    }

    public function get($key, $default = null)
    {
        return isset($this->src[$key]) ? $this->src[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->src[$key] = $value;
    }

    public function delete($key)
    {
        if (isset($this->src[$key])) {
            unset($this->src[$key]);
            return true;
        } else {
            return false;
        }
    }

    public function deleteAll($keys)
    {
        $this->src = array_diff_key($this->src, array_flip($keys));
    }

    public function extract($key, $default = null)
    {
        if (isset($this->src[$key])) {
            $res = $this->src[$key];
            unset($this->src[$key]);
            return $res;
        } else {
            return $default;
        }
    }

    public function getRaw()
    {
        return $this->src;
    }
} 