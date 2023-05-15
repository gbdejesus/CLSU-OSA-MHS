<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'student_id',
        'college',
        'course',
        'year_level',
        'section',
        'phone',
        'email',
        'password',
        'role',
        'clients',
        'counselors',
        'evaluated',
        'two_fa_code',
        'two_fa_expiry',
        'two_fa_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
    ];

    /**
     * Generate 6 digits MFA code for the User
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false; // Don't update the 'updated_at' field yet

        $this->two_fa_code = rand(100000, 999999);
        $this->two_fa_expiry = now()->addMinutes(10);
        $this->save();
    }

    /**
     * Reset the MFA code generated earlier
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false; // Don't update the 'updated_at' field yet

        $this->two_fa_code = null;
        $this->two_fa_expiry = null;
        $this->save();
    }
}
