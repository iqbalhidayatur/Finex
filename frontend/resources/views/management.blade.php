<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/global.css')
    @vite('resources/css/management.css')
</head>

<body>
    <main>
        <section class="d-flex flex-row">
            <aside class="justify-content-start align-items-center flex-column ps-4 pe-4">
                @include('_sidebar')
            </aside>

            <div class="main-content">
                @include('_header')

                <div class="main p-4 d-flex gap-3 flex-column">
                    <h2>Management</h2>
                    <p>Manage your budgeting here</p>

                    <div class="d-flex w-100 justify-content-center align-items-center gap-3">
                        <input type="text" class="d-flex w-100">
                        <div class="icon-container d-flex justify-content-center align-items-center">
                            <i class="icon bi bi-search"></i>
                        </div>
                    </div>

                    <div class="type-container d-flex flex-row gap-2 justify-content-start align-items-center">
                        <div class="wallet-type">All</div>
                        <div class="wallet-type">Monthly Expenses</div>
                        <div class="wallet-type">Operational</div>
                        <button><i class="bi bi-plus"></i></button>
                    </div>

                    <div class="wallet-container">
                        <div class="wallet-card card d-flex flex-column justify-content-center align-items-center gap-4">
                            <i class="bi bi-wallet"></i>
                            <h2>Wallet 1</h2>
                            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore maiores quod</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="wallet-card card d-flex flex-column justify-content-center align-items-center gap-4">
                            <i class="bi bi-wallet"></i>
                            <h2>Wallet 1</h2>
                            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore maiores quod</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="wallet-card card d-flex flex-column justify-content-center align-items-center gap-4">
                            <i class="bi bi-wallet"></i>
                            <h2>Wallet 1</h2>
                            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore maiores quod</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="wallet-card card d-flex flex-column justify-content-center align-items-center gap-4">
                            <i class="bi bi-wallet"></i>
                            <h2>Wallet 1</h2>
                            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore maiores quod</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="wallet-card card d-flex flex-column justify-content-center align-items-center gap-4">
                            <div class="add-wallet d-flex justify-content-center align-items-center">
                                <i class="bi bi-plus"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>