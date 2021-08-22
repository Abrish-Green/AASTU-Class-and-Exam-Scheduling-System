<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
   public function basic_email() {
      $data = array('name'=>"AASTU Class and Exam Scheduling System");

      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('abrhammuche9@gmail.com', 'Abrham Muche')->subject
            ('Password Resetting Email');
         $message->from('Abrham365muche@gmail.com','Mr Abrham');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email() {
      $data = array('name'=>"AASTU Class and Exam Scheduling System");
      Mail::send('mail', $data, function($message) {
         $message->to('abrhammuche9@gmail.com', 'Abrham Muche')->subject
            ('Password Resetting Email');
         $message->from('Abrham365muche@gmail.com','Mr Abrham');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"AASTU Class and Exam Scheduling System");
      Mail::send('mail', $data, function($message) {
         $message->to('abrhammuche9@gmail.com', 'Abrham Muche')->subject
            ('Password Resetting Email');
         $message->attach(public_path() .'\public\uploads\image.png');
         $message->attach(public_path() .'\public\uploads\test.txt');
         $message->from('Abrham365muche@gmail.com','Mr Abrham');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}

