<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Libs\CodeGenerator;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ServiceGenerator extends BaseGenerator
{
    protected string $stub = __DIR__ . '/stubs/service.stub';

    public function generate($serviceName, $modelName): bool|string
    {
        $name = str_replace('/', '\\', $serviceName);
        $modelName = str_replace('/', '\\', $modelName);
        $path = static::guessClassFileName($name);
        $dir = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path) && !$this->overwrite) {
            abort(HttpResponse::HTTP_BAD_REQUEST, "Service [$name] already exists!");
        } else {
            $files->delete($path);
        }

        $stub = $files->get($this->stub);

        $stub = $this->replaceClass($stub, $name)
            ->replaceModel($stub, $modelName)
            ->replaceNamespace($stub, $name)
            ->replaceSpace($stub);

        $files->put($path, $stub);
        $files->chmod($path, 0777);

        return $path;
    }

    public function replaceModel(&$stub, $name): static
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace(['{{ ModelName }}', '{{ UseModel }}'], [$class, $name], $stub);

        return $this;
    }
}
