<?php


if (! function_exists('uploadImage')) {

    function uploadImage($image, $width, $height) {

        $dir = 'profiles/';
        $path = storage_path('app/public/' . $dir);

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $imageName =  time() . '_' . rand(00, 99) . '.' . $image->getClientOriginalExtension();
        $fullPocation  = $path . $imageName ;

        Image::make($image)->resizeCanvas($width, $height)->save($fullPocation);
        return $dir . $imageName ;
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
