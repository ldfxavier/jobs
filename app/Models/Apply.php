<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{

    private function check()
    {
        $count = $this->where([['user_id', '=', $this->user_id], ['jobs_id', '=', $this->jobs_id]])->count();

        if ($count > 0):
            return true;
        endif;
        return false;
    }

    public function mount($applies, $type = 'user')
    {
        $array = [];
        $User = new User;
        $Jobs = new Jobs;

        foreach ($applies as $r):
            $array[] = [
                'id' => $r->id,
                'user' => $type === 'user' ? $User->find($r->user_id) : $r->user_id,
                'jobs' => $type === 'jobs' ? $Jobs->find($r->jobs_id) : $r->jobs_id,
                'status' => $r->status,
                'created_at' => date("d/m/Y H:m:s", strtotime($r->created_at)),
                'updated_at' => date("d/m/Y H:m:s", strtotime($r->updated_at)),
            ];
        endforeach;

        return $array;
    }

    public function store($request)
    {
        $this->user_id = $request->user_id;
        $this->jobs_id = $request->jobs_id;
        $this->status = 1;

        $check = $this->check();

        if (!$check):
            try {
                $this->save();
                return response(['message' => 'Cadidatura enviada com sucesso!']);
            } catch (Exception $e) {
                return response(sqlError($e->errorInfo), 400);
            } else :
            return response(['message' => 'Você já se candidatou para essa vaga!'], 401);
        endif;
    }
}
