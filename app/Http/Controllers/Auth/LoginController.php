<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\Exception;
use Illuminate\Support\Facades\Auth;
use App\User as AppUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use League\OAuth1\Client\Server\User as ServerUser;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return \Illuminate\Http\Response
    */
   public function redirectToProvider($provider)
   {
       return Socialite::driver($provider)->redirect();
   }
   /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback($provider)
   {
        // テスト
        // $user = Socialite::driver($provider)->redirect();
        // dd($user);

       //① githubとの連携が出来たら（try）、出来なかったら（cathch）
       try{
           $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e){
            return redirect('/login');
        }
        
        // ②$userに（gihub）からのユーザー情報を抽出してそれを④で照合する
        // provider_id=gihubでの登録されたID   provider_name=github($provider)
        $user = User::where(['provider_id' => $socialUser->getId(), 'provider_name' => $provider])->first();

        // ③もし$user情報がデータベースになかったらDBに登録する
        if(!$user){
            $user = User::create([
                'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                ]);
            }

            // ④$user情報をDBと照合してログインを遂行する
            // 既に登録されているユーザー限定でログインを実行すする
            Auth::login($user, true);
            
            // ⑤全て終えたら、トップ画面へとリダイレクグ
            return redirect('/posts');
   }
}
