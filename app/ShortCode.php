<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShortCode extends Model
{

    public $table = 'short_code';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'url',
        'shortCode',
        'message',
        'created_at',
        'updated_at',
    ];

    public static function getUrl($shortCode){
        return self::where('shortCode', $shortCode)
            ->first();
    }

    public static function generateCode($length = 6){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public static function generateUrl(){ 
        do {
            $code = self::generateCode();
            $exist = self::where('shortCode', $code)->exists();
        } while ($exist);
        
        return $code;
    }

    public static function generateShortUrl($url,$requestUrl){
        $unique = self::generateUrl();
        self::create([
            'url' => $url,
            'shortCode' => $unique,
        ]);
        $domain = $requestUrl . '/'. $unique;
        return $domain;
    }
}
