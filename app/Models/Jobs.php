<?php
namespace App\Models;

use App\Models\Apply;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jobs extends Model
{
    public function store($data)
    {
        try {
            $user = auth()->user();
            $this->uuid = Str::uuid();
            $this->user_id = $user->id;
            $this->title = $data->title;
            $this->description = $data->description;
            $this->place = $data->place;
            $this->day = $data->day;
            $this->hour = $data->hour;
            $this->pay = $data->pay;
            $this->status = 1;

            if ($this->save()):
                return response(['message' => 'Job criado com sucesso!']);
            endif;
        } catch (Exception $e) {
            return response(sqlError($e->errorInfo), 400);
        }
    }

    public function show($id)
    {
        $Jobs = $this->find($id);
        $Apply = new Apply;
        $applies = $Apply->where('jobs_id', $id)->get();

        if ($Jobs):
            $Jobs->user;
            $Jobs->apply = $Apply->mount($applies);
            $Jobs->user->image = asset('storage/' . $Jobs->user->image);

            return response($Jobs);
        endif;

        return response(['message' => 'Job não encontrado!'], 404);
    }

    public function jobsUser()
    {
        $User = auth('api')->user();
        $Jobs = $this->where('user_id', $User->id)->orderBy('id', 'desc')->get();

        if ($Jobs):
            $array = [];
            foreach ($Jobs as $r):
                $r->user;
                $r->user->image = asset('storage/' . $r->user->image);
                $array[] = $r;
            endforeach;

            return response($array);
        endif;

        return response(['message' => 'Job não encontrado!'], 404);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
