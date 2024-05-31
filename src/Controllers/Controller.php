<?php
namespace Hsj\XePlugin\ChatPlugin\Controllers;

use App\Facades\XeFrontend;
use App\Facades\XePresenter;
use App\Http\Controllers\Controller as BaseController;
use GuzzleHttp\Client;
use Hsj\XePlugin\ChatPlugin\Events\SendMessage;
use Hsj\XePlugin\ChatPlugin\Plugin;
use Illuminate\Http\Request;

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

    public function checkSoketiStatus()
    {
        $client = new Client();

        try {
            $response = $client->request('GET', 'http://chat-plugin.test:6001', [
                'timeout' => 5,
            ]);

            if ($response->getStatusCode() === 200) {
                return response()->json(['status' => 'running']);
            } else {
                return response()->json(['status' => 'not_running']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'not_running']);
        }

//        $pluginDir = base_path('plugins/chat-plugin');
//        $soketiCommand = "cd {$pluginDir} && ./script.sh";
//        $output = [];
//        $returnValue = null;
//
//
//        exec($soketiCommand, $output, $returnValue);
//
//        if ($returnValue === 0) {
//            return response()->json(['status' => 'success', 'message' => 'Soketi server started', 'output' => $output]);
//        } else {
//            return response()->json(['status' => 'error', 'message' => 'Failed to start Soketi server', 'output' => $output], 500);
//        }
    }
}
