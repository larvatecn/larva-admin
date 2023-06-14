<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * Barcode 条形码 https://aisuda.bce.baidu.com/amis/zh-CN/components/barcode
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class Barcode extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'barcode');

    }

    /**
     * 外层类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 指定为 barcode 渲染器。
     */
    public function type($value = 'barcode')
    {
        return $this->set('type', $value);
    }

}
