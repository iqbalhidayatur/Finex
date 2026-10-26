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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4 mt-3"
                        role="alert">
                        {{ session('success') }}

                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mx-4 mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="main p-4 d-flex gap-3 flex-column">
                    <h2>Management</h2>
                    <p>Manage your budgeting here</p>

                    <form action="{{ route('wallets.index') }}" method="GET"
                        class="d-flex w-100 gap-3 align-items-center">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari wallet..."
                            value="{{ request('search') }}"
                        >

                        <button type="submit"
                                class="icon-container d-flex justify-content-center align-items-center">
                            <i class="icon bi bi-search"></i>
                        </button>
                    </form>

                    <div class="type-container d-flex flex-row gap-2 justify-content-start align-items-center flex-wrap">
                        <a href="{{ route('wallets.index') }}"
                        class="wallet-type text-decoration-none">
                            All
                        </a>

                        @foreach ($categories as $category)
                            <a href="{{ route('wallets.index', ['category' => $category]) }}"
                            class="wallet-type text-decoration-none">
                                {{ $category }}
                            </a>
                        @endforeach

                        <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#walletModal">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>

                    <div class="wallet-container d-flex justify-content-center align-items-center">
                        @forelse ($wallets as $wallet)
                            <div class="wallet-card card">
                                <div class="wallet-header">
                                    <div class="wallet-icon blue">
                                        <i class="bi bi-wallet2"></i>
                                    </div>

                                    <div class="dropdown">
                                        <button class="wallet-menu"
                                                data-bs-toggle="dropdown"
                                                type="button">
                                            <i class="bi bi-three-dots"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item"
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#walletModal"
                                                        data-id="{{ $wallet->id }}"
                                                        data-name="{{ $wallet->name }}"
                                                        data-description="{{ $wallet->description }}"
                                                        data-budget="{{ $wallet->budget }}"
                                                        data-category="{{ $wallet->category }}"
                                                        data-update-url="{{ route('wallets.update', $wallet) }}">
                                                    <i class="bi bi-pencil me-2"></i>
                                                    Edit Wallet
                                                </button>
                                            </li>

                                            <li>
                                                <form action="{{ route('wallets.destroy', $wallet) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus wallet ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="dropdown-item text-danger"
                                                            type="submit">
                                                        <i class="bi bi-trash me-2"></i>
                                                        Hapus Wallet
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <h3>{{ $wallet->name }}</h3>

                                <p class="description">
                                    {{ $wallet->description ?: 'Tidak ada deskripsi.' }}
                                </p>

                                <div class="wallet-balance">
                                    <span>Total Budget</span>
                                    <h2>Rp{{ number_format($wallet->budget, 0, ',', '.') }}</h2>
                                </div>

                                <div class="wallet-footer">
                                    <span>Kategori</span>
                                    <strong>{{ $wallet->category }}</strong>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-wallet2 fs-1"></i>
                                <h4 class="mt-3">Belum ada wallet</h4>
                                <p>Buat wallet untuk mulai mengatur anggaran.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>


        <div class="modal fade" id="walletModal" tabindex="-1"
            aria-labelledby="walletModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="walletForm"
                    action="{{ route('wallets.store') }}"
                    data-store-url="{{ route('wallets.store') }}"
                    method="POST">
                        @csrf

                        <div id="walletMethod"></div>

                        <div class="modal-header">
                            <h5 class="modal-title" id="walletModalLabel">
                                Tambah Wallet
                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="walletName" class="form-label">
                                    Nama Wallet
                                </label>
                                <input type="text" name="name" id="walletName"
                                    class="form-control" required
                                    maxlength="255">
                            </div>

                            <div class="mb-3">
                                <label for="walletDescription" class="form-label">
                                    Deskripsi
                                </label>
                                <textarea name="description"
                                        id="walletDescription"
                                        class="form-control"
                                        rows="3" maxlength="1000"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="walletBudget" class="form-label">
                                    Total Budget (Rp)
                                </label>
                                <input type="number" name="budget"
                                    id="walletBudget" class="form-control"
                                    min="0" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="walletCategory" class="form-label">
                                    Kategori
                                </label>
                                <input type="text" name="category"
                                    id="walletCategory" class="form-control"
                                    list="walletCategories"
                                    maxlength="100" required>

                                <datalist id="walletCategories">
                                    <option value="Monthly Expenses">
                                    <option value="Operational">
                                    <option value="Savings">
                                    <option value="Emergency Fund">
                                </datalist>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-primary"
                                    id="walletSubmit">
                                Simpan Wallet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    @vite('resources/js/management.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>