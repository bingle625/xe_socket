<?php
namespace Hsj\XePlugin\ChatPlugin;

use App\Facades\XeFrontend;
use App\Facades\XePresenter;
use Hsj\XePlugin\ChatPlugin\Events\SendMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $title = 'ChatPlugin plugin';

        // set browser title
        XeFrontend::title($title);

        // load css file
        XeFrontend::css(Plugin::asset('assets/style.css'))->load();

        // output
        return XePresenter::make('chat-plugin::views.index', ['title' => $title]);
    }

    public function sendMessage(Request $request)
    {
        $message = [
            'message' => $request->input('message'),
            'user' => auth()->user()->getKey(),
            'user_name' => auth()->user()->getDisplayName()
        ];

        broadcast(new SendMessage($message));

        return XePresenter::makeApi([
            'success' => 'success',
            'message' => $request->input('message'),
            'user_name' => auth()->user()->getDisplayName()
        ]);
    }
}
