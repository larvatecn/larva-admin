<?php

namespace Larva\Admin\Libs\CodeGenerator;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ControllerGenerator extends BaseGenerator
{
    protected string $stub = __DIR__ . '/stubs/controller.stub';

    protected string $serviceName = '';

    protected string $tableName = '';

    protected string $title = '';

    protected Collection $columns;

    protected bool $needTimestamp = false;

    public function timestamps(bool $need): static
    {
        $this->needTimestamp = $need;

        return $this;
    }

    public function serviceName($serviceName): static
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    public function tableName($tableName): static
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function title($title): static
    {
        $this->title = $title;

        return $this;
    }

    public function columns($columns): static
    {
        $this->columns = $columns;

        if ($this->columns->isEmpty()) {
            abort(HttpResponse::HTTP_BAD_REQUEST, 'Table fields can\'t be empty');
        }

        return $this;
    }

    public function generate($name): bool|string
    {
        $name = str_replace('/', '\\', $name);
        $path = static::guessClassFileName($name);
        $dir  = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path) && !$this->overwrite) {
            abort(HttpResponse::HTTP_BAD_REQUEST, "Controller [$name] already exists!");
        }else{
            $files->delete($path);
        }

        $stub = $files->get($this->stub);

        $stub = $this->replaceClass($stub, $name)
            ->replaceNamespace($stub, $name)
            ->replaceService($stub)
            ->replaceListContent($stub)
            ->replaceFormContent($stub)
            ->replaceDetailContent($stub)
            ->replaceSpace($stub);

        $files->put($path, $stub);
        $files->chmod($path, 0777);

        return $path;
    }

    protected function replaceService(&$stub): static
    {
        $name = str_replace('/', '\\', $this->serviceName);

        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace(['{{ ServiceName }}', '{{ UseService }}'], [$class, $name], $stub);

        return $this;
    }

    protected function replaceListContent(&$stub): static
    {
        $list = collect();

        $primaryKey     = $this->primaryKey ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);
        $list->push("TableColumn::make()->name('{$primaryKey}')->label('{$primaryKeyName}')->sortable()");

        $this->columns->map(function ($column) use (&$list) {
            $item = '';

            $label = Arr::get($column, 'comment') ?? Str::studly($column['name']);

            $item .= "TableColumn::make()->name('{$column['name']}')->label('{$label}')";

            if ($column['type'] == 'integer') {
                $item .= '->sortable(true)';
            }

            $list->push($item);
        });

        if ($this->needTimestamp) {
            $list->push("TableColumn::make()->name('created_at')->label(__('admin.created_at'))->type('datetime')->sortable(true)");
            $list->push("TableColumn::make()->name('updated_at')->label(__('admin.updated_at'))->type('datetime')->sortable(true)");
        }

        $list = $list->implode(",\n\t\t\t\t") . ',';

        $stub = str_replace('{{ ListContent }}', $list, $stub);

        return $this;
    }

    protected function replaceFormContent(&$stub): static
    {
        $form = collect();

        $this->columns->where('index', '!=', 'primary')->map(function ($column) use (&$form) {
            $item = '';

            $label = Arr::get($column, 'comment') ?? Str::studly($column['name']);

            $item .= "TextControl::make()->name('{$column['name']}')->label('{$label}')";

            $form->push($item);
        });

        $form = $form->implode(",\n\t\t\t") . ',';

        $stub = str_replace('{{ FormContent }}', $form, $stub);

        return $this;
    }

    protected function replaceDetailContent(&$stub): static
    {
        $detail = collect();

        $primaryKey     = $this->primaryKey ?? 'id';
        $primaryKeyName = strtoupper($primaryKey);
        $detail->push("TextControl::make()->static()->name('{$primaryKey}')->label('{$primaryKeyName}')");

        $this->columns->map(function ($column) use (&$detail) {
            $item = '';

            $label = Arr::get($column, 'comment') ?? Str::studly($column['name']);

            $item .= "TextControl::make()->static()->name('{$column['name']}')->label('{$label}')";

            $detail->push($item);
        });

        if ($this->needTimestamp) {
            $detail->push("TextControl::make()->static()->name('created_at')->label(__('admin.created_at'))");
            $detail->push("TextControl::make()->static()->name('updated_at')->label(__('admin.updated_at'))");
        }

        $detail = $detail->implode(",\n\t\t\t");

        $stub = str_replace('{{ DetailContent }}', $detail, $stub);

        return $this;
    }
}
