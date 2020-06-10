<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Jobs;
use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

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
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Create user.
     *
     * @return array
     */
    public function store($data)
    {
        try {
            $this->uuid = Str::uuid();
            $this->name = $data->name;
            $this->email = $data->email;
            $this->phone = $data->phone;
            $this->type = 1;
            $image = $data->file('image');

            if ($image):
                $this->image = $image->store('images/avatar', 'public');
            endif;

            if (empty($data->password)):
                return response([
                    'message' => 'O campo "password" não pode ser vazio!',
                ], 400);
            endif;
            $this->password = Hash::make($data->password);
            if ($this->save()):
                if (!empty($data->street)):
                    $Address = new Address;
                    $Address->user_id = $this->id;
                    $Address->uuid = Str::uuid();
                    $Address->street = $data->street;
                    $Address->number = $data->number;
                    $Address->city = $data->city;
                    $Address->state = $data->state;

                    if (!$Address->save()):
                        return "error";
                    endif;
                endif;
                return response([
                    'message' => 'Usuário cadastrado com sucesso!',
                ]);
            endif;
        } catch (Exception $e) {
            return response(sqlError($e->errorInfo), 400);
        }
    }

    /**
     * Update user.
     *
     * @return array
     */
    public function updateUser($data)
    {
        try {
            $update = [
                'name' => $data->name,
                'phone' => $data->phone,
            ];
            $id = auth('api')->user()->id;
            if ($this->where('id', $id)->update($update)):
                return response([
                    'message' => 'Dados atualizados com sucesso!',
                ]);
            endif;

        } catch (Exception $e) {
            return response(sqlError($e->errorInfo), 400);
        }
    }

    /**
     * Show user.
     *
     * @return array
     */
    public function show($id)
    {
        try {
            $user = $this->find($id);

            if ($user):
                $user->image = asset('storage/' . $user->image);
                $user->address;
                $user->jobs;
                return response($user);
            endif;
        } catch (Exception $e) {
            return response(['message' => 'Você não tem permissão para acessar esse usuário!'], 401);
        }
    }

    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
