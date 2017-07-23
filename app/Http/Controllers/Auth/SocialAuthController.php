<?php
namespace App\Http\Controllers\Auth;

use Socialite;
use App\Entity\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialUser;

/**
 * Class SocialAuthController
 * @package App\Http\Controllers\Auth
 */
class SocialAuthController extends Controller
{
    /**
     * The OAuth Provider.
     *
     * @var string
     */
    protected $provider;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->provider = $request->provider;
        $this->redirectTo = route('cars.index', [], false);
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * Check if the user already exists in the database by looking up
     * their provider_id in the database. If the user exists, log them in.
     * Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        // Get the user information from the provider
        $socialUser = Socialite::driver($this->provider)->user();
        $user = $this->findOrCreateUser($socialUser);
        Auth::login($user);

        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     *
     * @param  \Laravel\Socialite\Contracts\User $user
     *
     * @return \App\Entity\User
     */
    protected function findOrCreateUser(SocialUser $socialUser)
    {
        // Search in database
        $user = User::where(['email' => $socialUser->email])->first();
        if ($user !== null) {
            return $user;
        }

        // Create if not found
        $socialUser->name = explode(' ', $socialUser->name, 2);

        return User::create([
            'first_name' => $socialUser->name[0],
            'last_name' => $socialUser->name[1],
            'email' => $socialUser->email,
            'password' => bcrypt('secret'),
        ]);
    }
}
