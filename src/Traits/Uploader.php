<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Traits;

use Illuminate\Support\Facades\Storage;

trait Uploader
{
    /**
     * 图片上传路径
     *
     * @return string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
     */
    public function uploadImagePath(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return admin_url('upload_image');
    }

    public function uploadImage(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        return $this->upload('image');
    }

    /**
     * 文件上传路径
     *
     * @return string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
     */
    public function uploadFilePath(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return admin_url('upload_file');
    }

    public function uploadFile()
    {
        return $this->upload();
    }

    /**
     * 富文本编辑器上传路径
     *
     * @return string
     */
    public function uploadRichPath()
    {
        return admin_url('upload_rich', true);
    }

    public function uploadRich()
    {
        $fromWangEditor = false;
        $file = request()->file('file');

        if (!$file) {
            $fromWangEditor = true;
            $file = request()->file('wangeditor-uploaded-image');
            if (!$file) {
                $file = request()->file('wangeditor-uploaded-video');
            }
        }

        if (!$file) {
            return $this->response()->additional(['errno' => 1])->fail(__('admin.upload_file_error'));
        }

        $path = $file->store(config('admin.upload.directory.rich'), config('admin.upload.disk'));

        $link = Storage::disk(config('admin.upload.disk'))->url($path);

        if ($fromWangEditor) {
            return $this->response()->additional(['errno' => 0])->success(['url' => $link]);
        }

        return $this->response()->additional(compact('link'))->success(compact('link'));
    }

    protected function upload($type = 'file')
    {
        $file = request()->file('file');

        if (!$file) {
            return $this->response()->fail(__('admin.upload_file_error'));
        }

        $path = $file->store(config('admin.upload.directory.' . $type), config('admin.upload.disk'));

        return $this->response()->success(['value' => $path]);
    }
}
