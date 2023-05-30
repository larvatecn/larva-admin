<?php

namespace Larva\Admin\Renderers;

/**
 * ComboCondition
 * 
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class ComboCondition extends BaseRenderer
{
    public function __construct()
    {

    }

    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    public function scaffold($value = '')
    {
        return $this->set('scaffold', $value);
    }

    public function test($value = '')
    {
        return $this->set('test', $value);
    }

}
