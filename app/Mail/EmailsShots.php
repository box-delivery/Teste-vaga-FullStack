<?php

namespace App\Mail;

use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \App\Models\EmailsShots as EMailsModel;

class EmailsShots extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var EMailsModel
     */
    public $store;

    /**
     * EmailsShots constructor.
     * @param EMailsModel $store
     */
    public function __construct(EMailsModel $store)
    {
        $this->store = $store;
    }

    /**
     * Build the message.
     *
     * @return $this|mixed
     */
    public function build()
    {
        $subject = $this->store->subject;
        $email = $this->store->users_emails;
        $this->subject("$subject");
        $this->to("$email", "Cliente Federal");
        $store = $this->store;
        return $this->view('panel.emailsShots.template.index', compact("store"));
    }
}
