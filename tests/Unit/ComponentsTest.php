<?php
use Inertia\Testing\AssertableInertia as Assert;

it('renders all Inertia pages correctly', function () {
    $routes = [
        '/dashboard' => 'Dashboard',
        '/students' => 'Students/Index',
        '/classes' => 'Classes/Index',
        '/teachers' => 'Teachers/Index',
        '/attendance' => 'Attendance/Search',

    ];

    foreach ($routes as $route => $component) {
        $this->signIn()->get($route)
            ->assertInertia(fn (Assert $page) =>
                $page->component($component)  // Check if the correct component is rendered
            );
    }
});

