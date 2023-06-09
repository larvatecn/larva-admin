<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Traits;

/**
 * 错误信息Trait类
 */
trait ErrorTrait
{
    /**
     * 错误信息
     *
     * @var string
     */
    protected string $error = '';

    /**
     * 设置错误信息
     *
     * @param string $error
     *
     * @return bool
     */
    protected function setError(string $error): bool
    {
        $this->error = $error ?: __('admin.unknown_error');
        return false;
    }

    /**
     * 获取错误信息
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * 是否存在错误信息
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }
}
