<?php

test('home page loads', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
