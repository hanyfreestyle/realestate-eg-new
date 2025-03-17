<?php

namespace App\FilamentCustom\Form;

use Filament\Forms\Components\FileUpload;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Storage;

class WebpImageUpload extends FileUpload {
    protected string $uploadDirectory = 'profile_photos';
    protected int $width = 300;
    protected int $height = 300;
    protected int $quality = 90;

    /**
     * تحديد المجلد الذي سيتم رفع الصورة إليه.
     */
    public function uploadDirectory(string $directory): static {
        $this->uploadDirectory = $directory;
        return $this;
    }

    /**
     * تحديد الأبعاد والجودة.
     */
    public function resize(int $width, int $height, int $quality = 90): static {
        $this->width = $width;
        $this->height = $height;
        $this->quality = $quality;
        return $this;
    }

    /**
     * تحديد الأبعاد والجودة.
     */


    /**
     * إعداد المكون وتخصيص معالج الرفع.
     */
    protected function setUp(): void {
        parent::setUp();

        $this
            ->acceptedFileTypes(['image/*'])
            ->hiddenLabel()
            ->image()
            ->imageEditor()
            ->imageCropAspectRatio('1:1')
            ->disk('public')
            ->directory($this->uploadDirectory)
            ->downloadable()
            ->nullable()
            ->deletable(true)
            ->reorderable(true)
            ->preserveFilenames()
            ->visibility('public')
            ->deleteUploadedFileUsing(function ($file) {
                Storage::disk('public')->delete($file);
            })
//            ->dehydrated(fn($state) => filled($state))
            ->dehydrated(true)
            ->saveUploadedFileUsing(function ($file, $record) {
                $manager = new ImageManager(new GdDriver());

                // تخزين الصورة أولاً
                $path = $file->store($this->uploadDirectory, 'public');

                // تحديد المسار الجديد بصيغة WEBP
                $newPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';

                // قص الصورة وتحويلها إلى WEBP
                $manager->read(Storage::disk('public')->path($path))
                    ->cover($this->width, $this->height)
                    ->encode(new WebpEncoder($this->quality))
                    ->save(Storage::disk('public')->path($newPath));

                // حذف النسخة الأصلية بعد التحويل
                Storage::disk('public')->delete($path);

                return $newPath;
            })
        ;

    }
}
