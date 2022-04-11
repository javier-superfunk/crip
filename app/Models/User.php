<?php

namespace App\Models;

use App\Models\Sistemas;
use App\Models\Proveedores;
use App\Models\UsuarioProveedor;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\AuditoriaModelosTrait;
use Spatie\Permission\Traits\HasRoles;
use App\Models\UsuarioInformanteSistema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\QueuedPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Notifications\QueuedEmailVerificationNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, TwoFactorAuthenticatable, AuditoriaModelosTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activo',
        'usu_insercion',
        'usu_modificacion',
        'usu_eliminacion',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Implementacion de busqueda
     *
     * String $cadena
     */
    public static function buscar(String $cadena)
    {
        return empty($cadena) ? static::query()
                            : static::query()->where('id', 'like', '%'.$cadena.'%')
                                            ->orWhere('name', 'like', '%'.$cadena.'%')
                                            ->orWhere('email', 'like', '%'.$cadena.'%')
                                            ->orWhereRelation('roles', 'name', 'like', '%'.$cadena.'%')
                                            ->orWhereRelation('proveedor', 'nombre', 'like', '%'.$cadena.'%');
    }

    /**
    *
    * Estos metodos se sobreescriben para que se envien
    * en una cola, y no tengamos que esperar nada cuando
    * se hace la llamada a cada uno en el controlador
    */

    //Overrideen sendPasswordResetNotification implementation
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedPasswordResetNotification($token));
    }
    
    //Overrideen sendEmailVerificationNotification implementation
    public function sendEmailVerificationNotification()
    {
        $this->notify(new QueuedEmailVerificationNotification);
    }

    /**
     *
     * RELACIONES
     *
    */
    public function usuarioInsercion()
    {
        return $this->belongsTo(User::class, 'usu_insercion');
    }

    public function usuarioModificacion()
    {
        return $this->belongsTo(User::class, 'usu_modificacion');
    }

    public function usuarioEliminacion()
    {
        return $this->belongsTo(User::class, 'usu_eliminacion');
    }

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sistemas(): BelongsToMany
    {
        return $this->belongsToMany(Sistemas::class, 'usuario_informante_sistemas', 'id_usuario', 'id_sistema')
                       ->using(UsuarioInformanteSistema::class)
                       ->withPivot('usu_insercion', 'usu_modificacion', 'usu_eliminacion')
                       ->withTimestamps();
    }

    /**
     * Proveedor al que pertenece el usuario
     *
     */
    public function proveedor(): BelongsToMany
    {
        return $this->belongsToMany(Proveedores::class, 'usuario_proveedor', 'id_usuario', 'id_proveedor')
                    ->using(UsuarioProveedor::class)
                    ->withPivot('usu_insercion', 'usu_modificacion', 'usu_eliminacion')
                    ->withTimestamps();
    }
}
