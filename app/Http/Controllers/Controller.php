<?php namespace App\Http\Controllers;

use App\Backend;
use App\Facades\HttpClient\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loadView($view, array $data = [])
    {
        $info = Http::get('point-info');
        $info = parseApiResponse($info);
        session(['mobile_number' => $info['user']['mobile_number'], 'name' => $info['user']['name'], 'admin' => $info['user']['admin'],
            'total_points' => $info['total_points'], 'available_points' => $info['available_points'],'is_verified' => $info['user']['is_verified']]);
        return view($view, $data);
    }
}
