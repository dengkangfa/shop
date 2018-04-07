<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Factory;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Overtrue\LaravelSocialite\Socialite;
use Overtrue\Socialite\UserInterface;

class AuthLoginController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $socialite = Socialite::driver('github')->user();

        return $this->handleProviderCallback($socialite);
    }

    public function redirectToQQ()
    {
        return Socialite::driver('qq')->redirect();
    }

    public function handleQQCallback()
    {
        $socialite = Socialite::driver('qq')->user();

        return $this->handleProviderCallback($socialite);
    }

    public function redirectToWeibo()
    {
        return Socialite::driver('weibo')->redirect();
    }

    public function handleWeiboCallback()
    {
        try {
            $socialite = Socialite::driver('weibo')->user();
        } catch (AuthorizationException $e) {
            return view('hint.error', ['status' => $e->getMessage(), 'url' => route('login')]);
        }

        return $this->handleProviderCallback($socialite);
    }

    private function handleProviderCallback($socialite)
    {
        if (!$socialite) {
            return view('hint.error', ['status' => '第三方登录出错']);
        }

        list($providerId, $providerName) = $providerType = $this->formatProvider($socialite['provider']);

        if (!$user = User::where($providerId, $socialite['id'])->first()) {
            $user = $this->createUserByProvider($socialite, $providerType);
        }

        \Auth::login($user, true);

        return redirect('/');
    }

    public function formatProvider($provider)
    {
        $provider = strtolower($provider);

        return [
            $provider . '_id',
            $provider . '_name'
        ];
    }

    public function createUserByProvider(UserInterface $provider, array $providerType)
    {
        list($providerId, $providerName) = $providerType;

        if ($user = User::where('email', $provider['email'])->first()) {
            $user->$providerId = $provider['id'];
            $user->$providerName = $provider['nickname'];
            $user->save();
        } else {
            $data = $this->getFormatFiledData($provider, $providerId, $providerName);
            $user = User::create($data);
        }

        return $user;
    }

    public function getFormatFiledData($provider, $providerId, $providerName)
    {
        $faker = Factory::create();

        $data = [
            'name' => $faker->uuid,
            'avatar' => $faker->imageUrl(120, 120),
            'email' => $faker->email
        ];

        if (! User::where('name', $provider['nickname'])->first()) {
            $data['name'] = $provider['nickname'];
        }

        if (isset($provider['avatar'])) {
            $data['avatar'] = $provider['avatar'];
        }

        if (isset($provider['email']) && $provider['email']) {
            $data['email'] = $provider['email'];
        }

        if (isset($provider['sex'])) {
            $data['sex'] = $provider['sex'];
        }

        $data[$providerId] = $provider['id'];
        $data[$providerName] = $provider['nickname'];
        $data['password'] = bcrypt('secret');
        $data['active_token'] = str_random(60);
        $data['is_active'] = 1;

        return $data;
    }
}
