<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * Table View 表格展现
 *
 * @author slowlyo
 * @version v3.0.0
 * @since 2023-05-13
 */
class TableView extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'table-view');

    }

    /**
     * 指定为 table-view 渲染器。
     */
    public function type($value = 'table-view')
    {
        return $this->set('type', $value);
    }

}
