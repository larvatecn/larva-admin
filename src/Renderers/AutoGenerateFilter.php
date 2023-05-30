<?php

namespace Larva\Admin\Renderers;

/**
 * AutoGenerateFilter
 * 
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class AutoGenerateFilter extends BaseRenderer
{
    public function __construct()
    {

    }

    /**
     * 过滤条件单行列数
     */
    public function columnsNum($value = '')
    {
        return $this->set('columnsNum', $value);
    }

    /**
     * 是否显示设置查询字段
     */
    public function showBtnToolbar($value = true)
    {
        return $this->set('showBtnToolbar', $value);
    }

}
