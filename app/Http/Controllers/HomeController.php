<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    protected $homeService;

    /**
     * HomeService constructor
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(Request $request)
    {
        return view('home');
    }

    public function receiveGift(Request $request)
    {
        $giftBox = $request->get('gift_box');
        return response()->json($this->homeService->receiveGift($giftBox));
    }

    public function confirm(Request $request)
    {
        $params = $request->only([
            'confirm',
            'rate',
            'message',
        ]);
        return response()->json($this->homeService->confirm($params));
    }
}
