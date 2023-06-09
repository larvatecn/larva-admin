<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * ImageToolbarAction
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class ImageToolbarAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('key', 'ROTATE_RIGHT');

    }

    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
    }

    /**
     *  可选值: ROTATE_RIGHT | ROTATE_LEFT | ZOOM_IN | ZOOM_OUT | SCALE_ORIGIN
     */
    public function key($value = '')
    {
        return $this->set('key', $value);
    }

    public function label($value = '')
    {
        return $this->set('label', $value);
    }

}
