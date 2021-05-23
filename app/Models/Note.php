<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string $table
     */
    protected $table = 'notes';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'uuid',
        'slug',
        'user_id',
        'title',
        'password',
        'language',
        'expire',
        'content',
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'lines',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return Collection
     */
    public function getLinesAttribute(): Collection
    {
        return collect(preg_split('/\r\n|\r|\n/', $this->content));
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        /** @var Carbon $created_at */
        $created_at = $this->created_at;
        return ! $created_at->add($this->expire)->diff(now())->invert;
    }

    /**
     * @param Request|null $request
     * @return bool
     */
    public function gate(Request $request = null): bool
    {
        if ($request == null) {
            $request = request();
        }

        if ($this->password != null && mb_strlen($this->password) > 0) {
            $session_key = sprintf('note_passwd_%s', $this->id);

            if (session()->has($session_key) && session()->get($session_key) == $this->password) {
                return true;
            }

            if ($request->has('password') && Hash::check($request->input('password'), $this->password)) {
                session()->put($session_key, $this->password);
                session()->save();
                return true;
            }

            return false;
        }

        return true;
    }

    /**
     * @param array $attributes
     * @return Builder|Model
     */
    public static function create(array $attributes = []): Builder|Model
    {
        $auto_generates = [
            'uuid' => Str::uuid(),
            'slug' => Str::random() . rand(0, 10000),
        ];
        if (isset($attributes['password']) && mb_strlen($attributes['password']) > 0) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return static::query()->create(array_merge($auto_generates, $attributes));
    }
}
