<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\SendCodeMail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->id() ],
            [ 'code' => $code ]
        );

        try {

            $details = [
                'title' => 'Correo de verificación - Proyecto',
                'code' => $code
            ];

            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));

        } catch (\Exception $e) {
            info("Error: ". $e->getMessage());
            dd($e);
        }
    }
}
