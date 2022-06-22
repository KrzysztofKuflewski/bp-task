<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Services\ApplicationsService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class ApplicationsController extends Controller
{
    private ApplicationsService $applicationsService;

    public function __construct(ApplicationsService $applicationsService)
    {
        $this->applicationsService = $applicationsService;
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(StoreApplicationRequest $request)
    {
        $application = $this->applicationsService->createApplication(
            [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'attachments' => $request->hasFile('attachments') ? $request->file('attachments') : []
            ]
        );

        return response(['application' => $application, 'message' => 'Application was created successfully.'], 201);
    }

    public function index()
    {
        return view('applications.index', ['applications' => Application::all()]);
    }


}
