<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\HtmlString;
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
                ->greeting('Hola!')
                ->subject(Lang::get('Verificación de Email'))
                ->line(Lang::get('Por favor hacé click en el botón de abajo para verificar tu dirección de correo electrónico.'))
                ->action(Lang::get('Confirmar Email'), $verificationUrl)
                ->line(Lang::get('Si no creaste una cuenta, no es necesario realizar ninguna otra acción.'))
                ->salutation(new HtmlString('Gracias,<br><strong>ISMP</strong>'));
        };
    }
}
