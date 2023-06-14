<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * SvgIcon
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class SvgIcon extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'custom-svg-icon');

    }

    /**
     * 设置图标的类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 设置图标的名称
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 指定为 custom-svg-icon 渲染器。
     */
    public function type($value = 'custom-svg-icon')
    {
        return $this->set('type', $value);
    }

}
