<?php

describe('Attendance test' , function(){
    test('Unauthenticated users cant view the Attendance page', function () {
        $response = $this->get('/attendance');

        $response->assertRedirect('/login');
    });
     test('authenticated users can view the Attendance page', function () {
        $response = $this->signIn()->get('/attendance');

         $response->assertOk();
        $response->assertStatus(200);
    });
});
