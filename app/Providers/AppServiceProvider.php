<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::$toMailCallback = function($notifiable, $verificationUrl) {
            return (new MailMessage)
                ->greeting("Hola")
                ->subject(Lang::get('Verificación de Email'))
                ->line(Lang::get('Por favor haga click en el botón de abajo para verificar su dirección de correo electrónico.'))
                ->action(Lang::get('Confirmar Email'), $verificationUrl)
                ->line(Lang::get('Si no creó una cuenta, no es necesario realizar ninguna otra acción.'));
                /*->salutation(new HtmlString(
                    Lang::get("Saludos.").'<br>' .'<strong>'. Lang::get("ISMP") . '</strong>'
                ));*/
        };
    }
}
