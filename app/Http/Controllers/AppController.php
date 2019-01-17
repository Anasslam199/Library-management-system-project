<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use URL;
class AppController extends Controller
{
    public function setlocale($locale)
    {

      if (!in_array($locale,['en','fr'])) {
        $locale = "en";
      }
     Session::put('locale',$locale);
     return Redirect(url(URL::previous()));

    }

}
