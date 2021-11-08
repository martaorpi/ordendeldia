<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;

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
                ->salutation(new HtmlString('Quedamos a tu disposición,<br><strong>Equipo ISMP</strong>'));
                //->action(new HtmlString('Si tiene problemas para hacer click en el botón "Confirmar Email" , copia y pega la URL a continuación en el navegador:'));
        };

        
        /*ResetPassword::$toMailCallback = function($notifiable, $url) {
            return (new MailMessage)
            ->greeting('Hola!')
            ->subject(Lang::get('Restablecimiento de Contraseña'))
            ->line(Lang::get('Recibimos una solicitud de restablecimiento de contraseña para tu cuenta.'))
            ->action(Lang::get('Restablecer Contraseña'), $url)
            ->line(Lang::get('Este link expira en :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Si no solicitaste un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.'))
            ->salutation(new HtmlString('Quedamos a tu disposición,<br><strong>Equipo ISMP</strong>'));
        };*/
    }
}
