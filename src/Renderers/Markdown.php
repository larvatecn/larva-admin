<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * Markdown 渲染
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class Markdown extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'markdown');

    }

    /**
     * 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 名称
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 外部地址
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * 指定为 markdown 渲染器。
     */
    public function type($value = 'markdown')
    {
        return $this->set('type', $value);
    }

    /**
     * 静态值
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

}
