<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * QRCodeImageSettings
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class QRCodeImageSettings extends BaseRenderer
{
    public function __construct()
    {

    }

    public function excavate($value = true)
    {
        return $this->set('excavate', $value);
    }

    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    public function width($value = '')
    {
        return $this->set('width', $value);
    }

    public function x($value = '')
    {
        return $this->set('x', $value);
    }

    public function y($value = '')
    {
        return $this->set('y', $value);
    }

}
