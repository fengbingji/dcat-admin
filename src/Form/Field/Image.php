<?php

namespace Dcat\Admin\Form\Field;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @method \Intervention\Image\EncodedImage encode(\Intervention\Image\Interfaces\EncoderInterface $encoder = new \Intervention\Image\Encoders\AutoEncoder()) EX:$encoded = $image->encode(new WebpEncoder(quality: 65));$encoded = $image->encode(new AutoEncoder(quality: 10));
 * @method \Intervention\Image\EncodedImage encodeByMediaType(null|string|\Intervention\Image\MediaType $type = null, mixed ...$options) 将图像编码为给定的媒体（mime）类型。如果没有指定媒体类型，则图像将被编码为最初读取的图像的 MIME 类型的格式。 Ex:$encoded = $image->encodeByMediaType('image/jpeg', progressive: true, quality: 20);//progressive:渐进式
 * @method \Intervention\Image\EncodedImage encodeByPath(null|string $path = null, mixed ...$options) 将图像编码为给定文件路径扩展名所代表的格式。添加可选参数来定义编码器选项。如果没有给出路径，图像将被编码为最初读取的图像的格式。注意，此方法不会写入给定的路径，而只是使用此信息来提取目标格式。 Ex:$encoded = $image->encodeByPath('images/example.jpg', progressive: true, quality: 10);
 * @method \Intervention\Image\EncodedImage encodeByExtension(null|string|\Intervention\Image\FileExtension $extension = null, mixed ...$options) 将图像编码为给定文件扩展名所代表的格式。使用可选的第二个参数定义图像质量。如果没有指定扩展名，则图像将被编码为原始读取图像的格式。 Ex:$encoded = $image->encodeByExtension('jpg', progressive: true, quality: 10);
 * @method \Intervention\Image\EncodedImage toJpeg(int $quality = 75, bool $progressive = false, null|bool $strip = null) 以给定的质量对当前图像实例进行 JPEG 格式编码，范围从 0 表示低质量到 100 表示最佳质量。
 * @method \Intervention\Image\EncodedImage toWebp(int $quality = 75, null|bool $strip = null) 以给定的质量对当前图像实例进行 WebP 图形格式编码，范围从 0 表示低质量到 100 表示最佳质量。
 * @method \Intervention\Image\EncodedImage toPng(bool $interlaced = false, bool $indexed = false) 以 PNG 格式对当前图像实例进行编码。interlaced:对图像进行隔行编码,默认情况下禁用; indexed:使用索引调色板编码 PNG 格式,默认情况下为真彩色（非索引）
 * @method \Intervention\Image\EncodedImage toGif(bool $interlaced = false) 以 GIF 格式对当前图像实例进行编码。interlaced:对图像进行隔行编码,默认情况下禁用。
 * @method \Intervention\Image\EncodedImage toBitmap() 以 Windows 位图格式对当前图像实例进行编码。
 * @method $this blur(int $amount = 1) Apply a gaussian blur filter with a optional amount on the current image. Use values between 0 and 100.
 * @method $this brightness(int $level) Changes the brightness of the current image by the given level. Use values between -100 for min. brightness. 0 for no change and +100 for max. brightness.
 * @method $this create(int $width, int $height) Factory method to create a new empty image instance with given width and height. You can define a background-color optionally. By default the canvas background is transparent.
 * @method $this drawCircle(int $x, int $y, \Closure|\Intervention\Image\Geometry\Circle $init) Draw a colored circle on the current image with its center position at the x, y coordinates. Define the overall appearance of the shape by passing a init callback as an optional parameter.
 * @method $this colorize(int $red, int $green, int $blue) Change the RGB color values of the current image on the given channels red, green and blue. The input values are normalized so you have to include parameters from 100 for maximum color value. 0 for no change and -100 to take out all the certain color on the image.
 * @method $this contrast(int $level) Changes the contrast of the current image by the given level. Use values between -100 for min. contrast 0 for no change and +100 for max. contrast.
 * @method $this crop(int $width, int $height, int $offset_x = 0, int $offset_y = 0, mixed $background = 'ffffff', string $position = 'top-left') Cuts a rectangular portion of the current image with a given width and height at a specified position. Pass optional x, y offset coordinates to move the crop by the specified number of pixels.
 * @method $this drawEllipse(int $x, int $y, \Closure|\Intervention\Image\Geometry\Ellipse $init) Draw a colored ellipse on the current image with its center position at the x, y coordinates. Define the overall appearance of the shape by passing a init callback as an optional parameter.
 * @method $this exif(null|string $query = null) Read Exif Information
 * @method $this flip() Mirror Image Vertically [垂直镜像]
 * @method $this flop() Mirror Image Horizontally [水平镜像]
 * @method $this gamma(float $correction) Performs a gamma correction operation on the current image.
 * @method $this greyscale() Turns image into a greyscale version.
 * @method $this place(mixed $element, string $position = 'top-left', int $offset_x = 0, int $offset_y = 0, int $opacity = 100) Insert Images
 * @method $this invert() Reverses all colors of the current image.
 * @method $this reduceColors(int $limit, mixed $background = 'transparent') Apply color quantization to the current image by reducing the numbers of distinct colors in the current image to the given limit. The number of colors is lowered in a way that the new image should be as visually similar as possible.
 * @method $this drawLine(\Closure|\Intervention\Image\Geometry\Line $init) Draw a line on the current image. Define the overall appearance of the shape by passing a init callback as an optional parameter.
 * @method $this read(mixed $input, string|array|\Intervention\Image\Interfaces\DecoderInterface $decoders = []) Read Image Sources
 * @method $this orientate() This method reads the EXIF image profile setting 'Orientation' and performs a rotation on the image to display the image correctly.
 * @method \Intervention\Image\Interfaces\ColorInterface pickColor(int $x, int $y, int $frame_key = 0) Read Colors of Certain Pixels
 * @method $this drawPixel(int $x, int $y, mixed $color = null) Draw a single pixel at given position defined by the coordinates x and y in a given color.
 * @method $this pixelate(int $size) Applies a pixelation effect to the current image with a given size of pixels.
 * @method $this drawPolygon(\Closure|\Intervention\Image\Geometry\Polygon $init) Draw a polygon on the current image. Define the overall appearance of the shape by passing a init callback as an optional parameter. [在当前图像上绘制一个多边形。通过传递初始化回调作为可选参数来定义形状的整体外观]
 * @method $this drawRectangle(int $x, int $y, \Closure|\Intervention\Image\Geometry\Rectangle $init) Draw a colored rectangle on the current image with its top left position at the x, y coordinates. Define the overall appearance of the shape by passing a init callback as an optional parameter [在当前图像上绘制一个彩色矩形，其左上角位置位于x、y坐标处。通过传递初始化回调作为可选参数来定义形状的整体外观]
 * @method $this resize(null|int $width = null, null|int $height = null) 简单拉伸图像到指定尺寸，可能导致图像变形
 * @method $this resizeDown(null|int $width = null, null|int $height = null) 缩小图像到指定尺寸，但不超过原始尺寸，简单拉伸
 * @method $this cover(int $width, int $height, string $position = 'center') 图像完全覆盖目标尺寸，可能会放大，可能会裁剪掉部分内容
 * @method $this coverDown(int $width, int $height, string $position = 'center') 缩小图片并覆盖目标尺寸，不放大，可能会裁剪内容
 * @method $this scale(null|int $width = null, null|int $height = null) 按比例缩小图片，确保完整显示，目标尺寸可能留空
 * @method $this scaleDown(null|int $width = null, null|int $height = null) 按比例缩小图片，确保完整显示，目标尺寸可能留白，不放大
 * @method $this pad(int $width, int $height, $background = 'ffffff', string $position = 'center') 按比例缩小图片，确保完整显示，用指定颜色填充留空
 * @method $this contain(int $width, int $height, $background = 'ffffff', string $position = 'center') 按比例缩放图片，确保完整显示，允许放大，用指定颜色填充留空
 * @method $this resizeCanvas(null|int $width = null, null|int $height = null, mixed $background = 'ffffff', string $position = 'center') 调整图像的画布大小，例如增加边框或裁剪图像边缘
 * @method $this rotate(float $angle, mixed $bgcolor = null) Rotate the current image counter-clockwise by a given angle. Optionally define a background color for the uncovered zone after the rotation.
 * @method $this sharpen(int $amount = 10) Sharpen current image with an optional amount. Use values between 0 and 100.
 * @method $this text(string $text, int $x, int $y, callable|\Intervention\Image\Interfaces\FontInterface $font) Write a text string at the basepoint position of x, y to the current image. You can define more details like font-size, font-file and alignment via a callback as the fourth parameter.
 * @method $this trim(int $tolerance = 0) Remove border areas of the image on all sides that have a similar color. The similarity of the color can be varied using the optional tolerance parameter.
 * @method $this filling(mixed $color, null|int $x = null, null|int $y = null) 用指定颜色填充坐标点相似的色块
 */
class Image extends File
{
    use ImageField;

    protected $rules = ['nullable', 'image'];

    protected $view = 'admin::form.file';

    public function __construct($column, $arguments = [])
    {
        parent::__construct($column, $arguments);

        $this->setupImage();
    }

    protected function setupImage()
    {
        if (! isset($this->options['accept'])) {
            $this->options['accept'] = [];
        }

        $this->options['accept']['mimeTypes'] = 'image/*';
        $this->options['isImage'] = true;
    }

    /**
     * @param  array  $options  support:
     *                          [
     *                          'width' => 100,
     *                          'height' => 100,
     *                          'min_width' => 100,
     *                          'min_height' => 100,
     *                          'max_width' => 100,
     *                          'max_height' => 100,
     *                          'ratio' => 3/2, // (width / height)
     *                          ]
     * @return $this
     */
    public function dimensions(array $options)
    {
        if (! $options) {
            return $this;
        }

        $this->mergeOptions(['dimensions' => $options]);

        foreach ($options as $k => &$v) {
            $v = "$k=$v";
        }

        return $this->rules('dimensions:'.implode(',', $options));
    }

    /**
     * Set ratio constraint.
     *
     * @param  float  $ratio  width/height
     * @return $this
     */
    public function ratio($ratio)
    {
        if ($ratio <= 0) {
            return $this;
        }

        return $this->dimensions(['ratio' => $ratio]);
    }

    /**
     * @param  UploadedFile  $file
     */
    protected function prepareFile(UploadedFile $file)
    {
        $this->callInterventionMethods($file->getRealPath(), $file->getMimeType());

        $this->uploadAndDeleteOriginalThumbnail($file);
    }
}
