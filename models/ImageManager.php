<?php

class ImageManager extends Model
{
    public function getImages()
    {
        return $this->getAll('images', 'Image');
    }
}