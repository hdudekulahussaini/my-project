<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
            min-height: 100vh
        }

        .card-split {
            overflow: hidden;
            border-radius: 12px
        }

        .card-left {
            background: linear-gradient(180deg, #5b46d8, #7a62ff);
            color: #fff;
            padding: 32px;
            display: flex;
            align-items: center
        }

        .card-left .brand {
            font-weight: 700;
            font-size: 1.25rem
        }

        .ill {
            max-width: 100%;
            opacity: .95
        }

        .btn-login {
            padding: .75rem 1rem;
            font-weight: 600
        }

        .btn-user {
            background: #0d6efd;
            border: none
        }

        .btn-admin {
            background: #6c757d;
            border: none
        }

        @media(min-width:768px) {
            .card-split {
                display: flex
            }

            .card-left {
                flex: 1
            }

            .card-right {
                flex: 1;
                padding: 32px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-9 col-lg-7">
                <div class="card card-split shadow-sm">
                    <div class="card-left d-none d-md-flex">
                        <div>
                            <div class="brand mb-2">MyShop</div>
                            <h4 class="mb-2">Welcome back</h4>
                            <p class="mb-3">Fast, secure access to your dashboard and store tools.</p>
                            <svg class="ill" width="240" height="160" viewBox="0 0 240 160" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="240" height="160" rx="12" fill="rgba(255,255,255,0.08)" />
                                <g fill="white" opacity="0.9">
                                    <circle cx="60" cy="50" r="20" />
                                    <rect x="100" y="35" width="90" height="14" rx="6" />
                                    <rect x="100" y="60" width="70" height="10" rx="5" />
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body card-right p-4">
                        <div class="text-center mb-3">
                            <img src="/backend/logo.png" alt="logo" style="height:48px;object-fit:contain">
                        </div>
                        <h3 class="text-center mb-2">Sign in</h3>
                        <p class="text-center text-muted mb-4">Select how you'd like to sign in</p>
                        <div class="d-grid gap-3">
                            <a href="{{ route('login.type', ['type' => 'user']) }}"
                                class="btn btn-user btn-login text-white">
                                <i class="bi bi-person-fill me-2"></i>Continue as User
                            </a>
                            <a href="{{ route('login.type', ['type' => 'admin']) }}"
                                class="btn btn-admin btn-login text-white">
                                <i class="bi bi-shield-lock-fill me-2"></i>Continue as Admin
                            </a>
                        </div>
                        <p class="text-center mt-3 text-muted">
                            No account? <a href="{{ route('register') }}">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
