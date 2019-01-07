<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
 {
    //  return $this->from('from@example.com')->subject("end the borrow of book")->View("Members.message")->with(

        // return $this->subject("end the borrow of book")->View("Members.message")->with(
          //"data",$this->data);
          return $this->from('from@example.com')->View("Members.message")->with("data", $this->data);

    }
}
