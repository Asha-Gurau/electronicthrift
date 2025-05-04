protected $routeMiddleware = [
    // Other middleware
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    // Custom middleware
    'admin' => \App\Http\Middleware\IsAdmin::class,
];
