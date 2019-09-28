<?php


if (! function_exists('uploadImage')) {

    function uploadImage($width, $height, $key = 'image', $dir = null) {

        if (request()->hasFile($key))
        {

            if($dir) {
                $dir = $dir . '/';
            }

            $path = storage_path('app/public/'. $dir);


            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $photo        = request()->file($key);
            $imageName    =  time() . '_' . rand(00, 99) . '.' . $photo->getClientOriginalExtension();
            $location  = $path . $imageName ;
            $path         = $location;

            Image::make($photo)->resizeCanvas( $width, $height )->save($path);
            return $dir . $imageName;
        }

        $imageName = null;
    }

}



if (! function_exists('attrTrans')) {

    function attrTrans($attr) {

        $default = config('app.default_locale');
        $curruntLocale = app()->getLocale();

        $locales = config('app.supported_languages');

        foreach ($locales as $lang)
        {
            if( $curruntLocale == $default )
            {
                return $attr;
            } elseif($curruntLocale == $lang) {
                $name = $attr.'_'.$lang;
                return  $name;
            }
        }
    }

}