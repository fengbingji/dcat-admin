<?php

namespace Dcat\Admin\Form\Field;

use Dcat\Admin\Exception\AdminException;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait ImageField
{
    /**
     * Intervention calls.
     *
     * @var array
     */
    protected $interventionCalls = [];

    /**
     * Thumbnail settings.
     *
     * @var array
     */
    protected $thumbnails = [];

    protected static $interventionAlias = [
        'filling' => 'fill',
    ];

    /**
     * Default directory for file to upload.
     *
     * @return mixed
     */
    public function defaultDirectory()
    {
        return config('admin.upload.directory.image');
    }

    /**
     * Execute Intervention calls.
     *
     * @param  string  $target
     * @param  string  $mime
     * @return mixed
     */
    public function callInterventionMethods($target, $mime)
    {
        if (! empty($this->interventionCalls)) {
            /**
             * @covers Image::make -> Image::read
             */
            $image = Image::read($target);

            $mime = $mime ?: finfo_file(finfo_open(FILEINFO_MIME_TYPE), $target);

            foreach ($this->interventionCalls as $call) {
                call_user_func_array(
                    [$image, $call['method']],
                    $call['arguments']
                )
                    /**
                     * @covers save($target, null, $mime) -> save($target)
                     * 因为新版不需要指定保存格式
                     */
                    ->save($target);
            }
        }

        return $target;
    }

    /**
     * Call intervention methods.
     *
     * @param  string  $method
     * @param  array  $arguments
     * @return $this
     *
     * @throws \Exception
     */
    public function __call($method, $arguments)
    {
        if (static::hasMacro($method)) {
            return parent::__call($method, $arguments);
        }

        /**
         * @covers ImageManagerStatic -> Image
         */
        if (! class_exists(Image::class)) {
            throw new AdminException('To use image handling and manipulation, please install [intervention/image] first.');
        }

        $this->interventionCalls[] = [
            'method'    => static::$interventionAlias[$method] ?? $method,
            'arguments' => $arguments,
        ];

        return $this;
    }

    /**
     * @param  string|array  $name
     * @param  int  $width
     * @param  int  $height
     * @return $this
     */
    public function thumbnail($name, int $width = null, int $height = null)
    {
        if (func_num_args() == 1 && is_array($name)) {
            foreach ($name as $key => $size) {
                if (count($size) >= 2) {
                    $this->thumbnails[$key] = $size;
                }
            }
        } elseif (func_num_args() == 3) {
            $this->thumbnails[$name] = [$width, $height];
        }

        return $this;
    }

    /**
     * Destroy original thumbnail files.
     *
     * @param  string|array  $file
     * @param  bool  $force
     * @return void.
     */
    public function destroyThumbnail($file = null, bool $force = false)
    {
        if ($this->retainable && ! $force) {
            return;
        }

        $file = $file ?: $this->original;
        if (! $file) {
            return;
        }

        if (is_array($file)) {
            foreach ($file as $f) {
                $this->destroyThumbnail($f, $force);
            }

            return;
        }

        foreach ($this->thumbnails as $name => $_) {
            // We need to get extension type ( .jpeg , .png ...)
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            // We remove extension from file name so we can append thumbnail type
            $path = Str::replaceLast('.'.$ext, '', $file);

            // We merge original name + thumbnail name + extension
            $path = $path.'-'.$name.'.'.$ext;

            if ($this->getStorage()->exists($path)) {
                $this->getStorage()->delete($path);
            }
        }
    }

    /**
     * Upload file and delete original thumbnail files.
     *
     * @param  UploadedFile  $file
     * @return $this
     */
    protected function uploadAndDeleteOriginalThumbnail(UploadedFile $file)
    {
        foreach ($this->thumbnails as $name => $size) {
            // We need to get extension type ( .jpeg , .png ...)
            $ext = pathinfo($this->name, PATHINFO_EXTENSION);

            // We remove extension from file name so we can append thumbnail type
            $path = Str::replaceLast('.'.$ext, '', $this->name);

            // We merge original name + thumbnail name + extension
            $path = $path.'-'.$name.'.'.$ext;

            /** @covers Image::make -> Image::read */
            $image = Image::read($file);

            /** @covers 直接改用 $image->scale 实现等比缩放 */
            // Resize image with aspect ratio
            $image->scale($size[0], $size[1]);

            /**
             * @covers $image->encode()->stream() -> $image->encode()
             */
            if (! is_null($this->storagePermission)) {
                $this->getStorage()->put("{$this->getDirectory()}/{$path}", $image->encode(), $this->storagePermission);
            } else {
                $this->getStorage()->put("{$this->getDirectory()}/{$path}", $image->encode());
            }
        }

        if (! is_array($this->original)) {
            $this->destroyThumbnail();
        }

        return $this;
    }
}
