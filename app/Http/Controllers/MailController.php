<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;


use Illuminate\Http\Request;

class MailController extends Controller
{

    public function index()
   {
       $mailData = [
           'title' => 'bruhhh',
           'body' => 'Szia Bence. Te vagyok a jövőböl, és ez a nap csak akkor nem lesz szar ha veszel egy bigmacket Krisztinek <3'
       ];
       
       
      for ($i=0; $i < 99; $i++) { 
        Mail::to('ulrich.bence@diak.szamalk-szalezi.hu')->send(new DemoMail($mailData));
        # code...
      }
       /*
       foreach(['gyorgy.krisztian@diak.szamalk-szalezi.hu'] as $recipient){
        Mail::to('paulusz.kristof.csanad@diak.szamalk-szalezi.hu')->send(new DemoMail($mailData));
       }
*/


       dd("Email is sent successfully.");
   }

}
