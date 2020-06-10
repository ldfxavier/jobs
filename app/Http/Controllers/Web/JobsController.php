<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $Jobs = new Jobs;
        $jobs = $Jobs->where('user_id', $user->id)->get();

        return view('web.jobs', ['jobs' => $jobs]);
    }

    public function show($id)
    {
        $Jobs = new Jobs;
        $jobs = $Jobs->show($id);

        return view('web.job', ['job' => $jobs->original]);
    }

    public function create()
    {
        return view('web.newjob');
    }

    public function store(Request $request)
    {
        $Jobs = new Jobs;
        $jobs = $Jobs->store($request);
        if ($jobs->status() === 200):
            return redirect()->route('web.index');
        endif;
        return view('web.newjob', ['error' => $jobs->original]);
    }
}
