<?php
namespace Hsj\XePlugin\ChatPlugin;

use Hsj\XePlugin\ChatPlugin\Events\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Xpressengine\Plugin\AbstractPlugin;

class Plugin extends AbstractPlugin
{
    /**
     * 이 메소드는 활성화(activate) 된 플러그인이 부트될 때 항상 실행됩니다.
     *
     * @return void
     */
    public function boot()
    {
        // implement code

        $this->route();
    }

    protected function route()
    {
        Route::middleware('web')->group(static::path('routes/common.php'));
//        Route::group(
//            ['prefix' => $this->getId(), 'middleware' => 'auth'],
//            static function () {
//                Route::get('/', [
//                    'as' => 'chat-plugin::index','uses' => 'Hsj\XePlugin\ChatPlugin\Controller@index'
//                ]);
//                Route::post('/message',[
//                    'as' => 'chat-plugin::send-message',
//                    'uses' => 'Hsj\XePlugin\ChatPlugin\Controller@sendMessage'
//                ]);
//                Route::get('/t', function (Request $request) {
//                    $message = [
//                        'text' => $request->input('message'),
//                        'user' => 'hi',
//                    ];
//
//                    broadcast(new SendMessage($message));
//                });
//            }
//        );

    }

    /**
     * 플러그인이 활성화될 때 실행할 코드를 여기에 작성한다.
     *
     * @param string|null $installedVersion 현재 XpressEngine에 설치된 플러그인의 버전정보
     *
     * @return void
     */
    public function activate($installedVersion = null)
    {
        // implement code
    }

    /**
     * 플러그인을 설치한다. 플러그인이 설치될 때 실행할 코드를 여기에 작성한다
     *
     * @return void
     */
    public function install()
    {
        // implement code
    }

    /**
     * 해당 플러그인이 설치된 상태라면 true, 설치되어있지 않다면 false를 반환한다.
     * 이 메소드를 구현하지 않았다면 기본적으로 설치된 상태(true)를 반환한다.
     *
     * @return boolean 플러그인의 설치 유무
     */
    public function checkInstalled()
    {
        // implement code

        return parent::checkInstalled();
    }

    /**
     * 플러그인을 업데이트한다.
     *
     * @return void
     */
    public function update()
    {
        // implement code
    }

    /**
     * 해당 플러그인이 최신 상태로 업데이트가 된 상태라면 true, 업데이트가 필요한 상태라면 false를 반환함.
     * 이 메소드를 구현하지 않았다면 기본적으로 최신업데이트 상태임(true)을 반환함.
     *
     * @return boolean 플러그인의 설치 유무,
     */
    public function checkUpdated()
    {
        // implement code

        return parent::checkUpdated();
    }
}
