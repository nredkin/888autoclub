<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/** @property string $name */
/** @property string $email */
/** @property string $password */
/** @property int $role_id */

/** @method find(int $id) */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const ROLE_ADMIN = 1;
    public const ROLE_MANAGER = 2;
    public const ROLE_CLIENT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active'           => 'boolean'
    ];

    public static function getRoleName(int $id): string
    {
        return match ($id) {
            1 => 'Администратор',
            2 => 'Менеджер',
            3 => 'Клиент',
            default => 'Не задана',
        };
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function isEmployee()
    {
        return in_array($this->role_id, [self::ROLE_ADMIN, self::ROLE_MANAGER]);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role_id === self::ROLE_MANAGER;
    }

    public function isClient(): bool
    {
        return $this->role_id === self::ROLE_CLIENT;
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
