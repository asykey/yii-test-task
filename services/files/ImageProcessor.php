<?php

namespace app\services\files;

use yii\base\Exception;

class ImageProcessor
{
    /**
     * @throws \ImagickException
     * @throws Exception
     */
    public function resizeImage(string $filePath, int $width = null, int $height = null): string
    {
        $originalImagick = new \Imagick($filePath);
        $originalImageWidth = $originalImagick->getImageWidth();
        $originalImageHeight = $originalImagick->getImageHeight();

        $originalImagick->resizeImage(
            $width ?? $originalImageWidth,
                $height ?? $originalImageHeight,
            \Imagick::FILTER_UNDEFINED,
            1
        );
        $resizedImageName = $this->generateFileName($filePath);
        $originalImagick->writeImage($resizedImageName);

        return $resizedImageName;
    }

    /**
     * @throws \ImagickException
     * @throws Exception
     */
    public function setWatermark(string $originalFilePath, string $watermarkPath): void
    {
        $originalImagick = new \Imagick($originalFilePath);
        $watermarkImagick = new \Imagick($watermarkPath);
        $coalescedImage = $originalImagick->coalesceImages();
        do {
            $coalescedImage->compositeImage($watermarkImagick, \Imagick::COMPOSITE_OVER, 10, 10);
        } while ($coalescedImage->nextImage());

        $coalescedImage->writeImages($this->generateFileName($originalFilePath), true);
    }

    /**
     * @throws Exception
     */
    private function generateFileName(string $filePath): string
    {
        $fileName = \Yii::$app->security->generateRandomString(12);
        return 'uploads/' . $fileName . '.' . $this->getExtension($filePath);
    }

    private function getExtension(string $filePath): string
    {
        $splittedName = explode('.', $filePath);
        return end($splittedName);
    }
}