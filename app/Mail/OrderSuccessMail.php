<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use SerializesModels;

    public $order_id;
    public $user_email;

    /**
     * Create a new message instance.
     *
     * @param  int  $order_id
     * @param  string  $user_email
     * @return void
     */
    public function __construct($order_id, $user_email)
    {
        $this->order_id = $order_id;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-success') 
            ->with([
                'order_id' => $this->order_id,
                'order_link' => route('retailer.order.success', ['order_id' => $this->order_id]),
            ])
            ->subject('आपका ऑर्डर सफलतापूर्वक प्लेस किया गया है!');
    }
}
