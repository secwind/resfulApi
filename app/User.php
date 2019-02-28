<?php

namespace App;

use App\User;
use App\Model\Invoice;
use App\Model\Product;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;



    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';
    protected $dates = ['daleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        // 'verification_token',
    ];

    public static function boot()
    {
        static::created(function ($user) {
            // Mail::to($user)->send(new UserCreated($user));
            Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
                $mailFrom = env('MAIL_FROM_ADDRESS');    
                $mailName = 'www.irespec.com';    

                $subject  = 'Welcome to Irespec.com';
                $m->from($mailFrom, $mailName);  // From: Your Application <wisanu.mywork@gmail.com>
                $m->to($user->email, $user->name)->subject($subject);   // To: "Mr.Wisanu Mail;" <mailF@example.com>
            });
        });

        static::updated(function ($user) {
            if ($user->isDirty('email')) {
                Mail::send('emails.changemail', ['user' => $user], function ($m) use ($user) {
                $mailFrom = env('MAIL_FROM_ADDRESS');    
                $mailName = 'www.irespec.com';    

                $subject  = 'Change Email Succesful';
                $m->from($mailFrom, $mailName);  // From: Your Application <wisanu.mywork@gmail.com>
                $m->to($user->email, $user->name)->subject($subject);   // To: "Mr.Wisanu Mail;" <mailF@example.com>
            });
            }
        });

        parent::boot();
    }

    public function setName ($name)
    {
        $this->attributes['name'] = strtolower($name);   
    } // ------  / setName 

    public function getName ( $name)
    {
        return ucwords($name);    
    } // ------  / getName 

    public function setEmail ($email)
    {
        $this->attributes['email'] = strtolower($email);   
    } // ------  / setEmail 

    public function isVerified ()
    {
        return $this->verified == User::VERIFIED_USER;    
    } // ------  / isVerified 

    public function isAdmin ()
    {
        return $this->admin == User::ADMIN_USER;    
    } // ------  / isAdmin 

    public static  function generateCode ()
    {
        return str_random(40);    
    } // ------  / generateCode 

    public function invoices ()
    {
        return $this->hasMany(Invoice::class, 'buyer_id');  
        // เอา id ของ users.id ไปจับกับ invoices.buyer_id 
    } // ------  / transactions 
}
