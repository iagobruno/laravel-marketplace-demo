<?php

test('Example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
