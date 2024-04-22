<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Role;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const DEFAULT_PASSWORD = 'password';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role',
        'nis',
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

    protected $appends = ['avatar_url'];

    protected function avatarUrl(): Attribute {
        return new Attribute(
            get: function() {
                if (empty($this->avatar) || is_null($this->avatar)) {
                    return asset('404_Black.jpg');
                }

                // TODO: Get from storage path!
                return $this->avatar;
            }
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isStudent(): bool {
        return Role::from($this->role) === Role::STUDENT;
    }

    public function isTeacher(): bool {
        return !$this->isStudent();
    }

    public function scopeStudent(Builder $query) {
        $query->where('role', Role::STUDENT->value);
    }

    public function scopeSearch(Builder $query, string|null $search) {
        $query->when($search, function(Builder $query) use ($search) {
            return $query->where('name', 'LIKE', $search . '%')
                        ->orWhere('nis', $search);
        });
    }

    public function scopeRender(Builder $query, int $size) {
        return $query->paginate($size)->withQueryString();
    }
}
