<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * Expandable
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class Expandable extends BaseRenderer
{
    public function __construct()
    {

    }

    /**
     * 行是否可展开表达式
     */
    public function expandableOn($value = '')
    {
        return $this->set('expandableOn', $value);
    }

    /**
     * 展开行自定义样式表达式
     */
    public function expandedRowClassNameExpr($value = '')
    {
        return $this->set('expandedRowClassNameExpr', $value);
    }

    /**
     * 已展开的key值
     */
    public function expandedRowKeys($value = '')
    {
        return $this->set('expandedRowKeys', $value);
    }

    /**
     * 已展开的key值表达式
     */
    public function expandedRowKeysExpr($value = '')
    {
        return $this->set('expandedRowKeysExpr', $value);
    }

    /**
     * 对应数据源的key值
     */
    public function keyField($value = '')
    {
        return $this->set('keyField', $value);
    }

    /**
     * 对应渲染器类型
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

}
