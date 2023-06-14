<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

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
