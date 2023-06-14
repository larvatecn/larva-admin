<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * IconItem
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class IconItem extends BaseRenderer
{
    public function __construct()
    {

    }

    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    public function position($value = '')
    {
        return $this->set('position', $value);
    }

}
