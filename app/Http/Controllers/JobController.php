<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->cursorPaginate(5);
    
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required', 'min:3',
            'salary' => 'required'
        ]);
    
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user->email)->queue(
          new JobPosted($job)
        );
    
        return redirect('/jobs');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job)
    {
        // if (Auth::user()->cannot('edit-job', $job)) { abort(403); }

        // Gate::define('edit-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });

        // if (Auth::guest()) {
        //     return redirect('/login');
        // }

        // if ($job->employer->user->isNot(Auth::user())) {
        //     abort(403);
        // }

        // Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // authorize
    
        request()->validate([
            'title' => 'required', 'min:3',
            'salary' => 'required'
        ]);
    
    
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
    
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        $job->delete();
    
        return redirect('/jobs');
    }
}
