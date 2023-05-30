<?php

namespace Larva\Admin\Renderers;

/**
 * IconChecked
 * 
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class IconChecked extends BaseRenderer
{
    public function __construct()
    {

    }

    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    public function svg($value = '')
    {
        return $this->set('svg', $value);
    }

}
