<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use App\ShortCode;

class GenerateController extends Controller
{
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function index(){
        return view('generate');
    }

    public function getShortUrl(Request $request){
        if (str_replace(' ', '', $request->url) != '' && filter_var($request->url, FILTER_VALIDATE_URL) != null) {
            $shortUrl = ShortCode::generateShortUrl($request->url, $this->url->to('/'));
            return redirect('generate')->with('shortUrl', $shortUrl);
        } else {
            return redirect('generate')->with('error', "Поле URL не должно быть пустым или не верно указан url \n Пример: https://google.ru");
        }
        
    }

    public function redirect(Request $request){
        $item = ShortCode::getUrl($request->code);
        
        if($item){
            return redirect($item->url);
        }
        else
            return abort(404);
    }
}
