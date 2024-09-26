<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

it('ensures all GET routes are available' , function(){
    $routes = Route::getRoutes();

    foreach ($routes as  $route) {
        if(in_array('GET', $route->methods()) && ! str_contains($route->uri, 'api') && !str_contains($route->uri, '{') ){
            $response = $this->signIn()->get(URL::to($route->uri));

            expect(in_array($response->getStatusCode(), [200 , 204 , 302]))->toBe(true);
        }
    }
});