<?php
namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Events extends Model
{
    public function store($data)
    {
        try {
            $this->uuid = Str::uuid();
            $this->name = $data->name;
            $this->description = $data->description;
            $this->status = 1;

            if ($this->save()):
                return json_encode(['error' => false, 'message' => 'Evento cadastrado com sucesso!']);
            endif;

        } catch (Exception $e) {
            return sqlError($e->errorInfo);
        }
    }
}
