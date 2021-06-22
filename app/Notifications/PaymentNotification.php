<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orderid, $purpose, $custName, $custEmail, $paymentTerm, $remainingtime)
    {
        $this->orderid = $orderid;
        $this->purpose = $purpose;
        $this->custName = $custName;
        $this->custEmail = $custEmail;
        $this->paymentTerm = $paymentTerm;
        $this->remainingtime = $remainingtime;

        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return arraydat
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->remainingtime > 0){
            return [
                'data' => "Užsakovas " . $this->custName . " (".  $this->custEmail .") dar nepateikė sąskaitos už užsakymą [". $this->orderid. "], užsakymo paskirtis: " . $this->purpose . ". Likęs dienų skaičius: " . $this->remainingtime . " dienos, galutinė data: " . $this->paymentTerm,
                'summary' => "Užsakovui " . $this->custName . " susimokėti už užsakymą [". $this->orderid. "] liko ".  $this->remainingtime ." diena" 
            ];
        }
        elseif($this->remainingtime == 0 ) {
            return [
                'data' => "Užsakovas " . $this->custName . " (".  $this->custEmail .") dar nepateikė sąskaitos už užsakymą [". $this->orderid. "], užsakymo paskirtis: " . $this->purpose . ". Likęs dienų skaičius: paskutinė diena, galutinė data: " . $this->paymentTerm,
                'summary' => "Užsakovui " . $this->custName . " susimokėti už užsakymą [". $this->orderid. "] liko paskutinė diena" 
            ];
        }
        else{
            $remTime = abs($this->remainingtime);
            return [
                'data' => "Užsakovas " . $this->custName . " (".  $this->custEmail .") sąskaitą už užsakymą [". $this->orderid. "], užsakymo paskirtis: " . $this->purpose . " vėluoja pateikti " . $remTime . " dienomis, galutinė data buvo: " . $this->paymentTerm,
                'summary' => "Užsakovas " . $this->custName . " už užsakymą [". $this->orderid. "] vėluoja susimokėti " . $remTime. " dienomis" 
            ];
        }
    }
}
