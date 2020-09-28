<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\CurrencyManager;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CurrencyManager $currencyManager)
    {
        $users = User::all();
        $currency = $request->get('currency', 'USD');

        return $this->convertRates($users, $currency, $currencyManager);
    }

    private function convertRates($users, $currency, $currencyManager)
    {
        $rates = $currencyManager->getRates($currency);
        foreach ($users as $user) {
            if ($user->currency == $currency) {
                continue;
            }

            $user->hourly_rate = number_format(round($user->hourly_rate * $rates[$user->currency], 2), 2);
            $user->currency = $currency;
        }
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'hourly_rate' => 'required|numeric',
            'currency' => 'required|in:USD,GBP,EUR'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->hourly_rate = $request->get('hourly_rate');
        $user->currency = $request->get('currency');
        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        //Updating email is not supported
        $request->validate([
            'name' => 'required',
            'hourly_rate' => 'required|numeric',
            'currency' => 'required|in:USD,GBP,EUR'
        ]);

        $user->name = $request->get('name');
        $user->hourly_rate = $request->get('hourly_rate');
        $user->currency = $request->get('currency');
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
