<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/global.css')
    @vite('resources/css/app.css')

    <title>Sign in</title>

</head>
<body>
    <main>
        <section>
            <div class="hero">
                <img src="{{ asset('assets/images/FinexPrimary.png') }}" alt="Logo">
            </div>
            <div class="form d-flex align-items-center flex-column">
                <div class="form-input">
                    <h1>Sign in</h1>
                    <p>Enter your email and password here</p>
                    <input type="email" placeholder="Email">
                    <input type="password" placeholder="Password">
                    <p class="pt-3 d-flex w-100 justify-content-end"><a href="">Forgot Password?</a></p>
                    <button class="signin">Sign in</button>
                    <button class="google"><i class="bi bi-google"></i> Sign in with google</button>
                </div>
                <p><a href="/register">Dont have an Account? Sign up</a></p>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>