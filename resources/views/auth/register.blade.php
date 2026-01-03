<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md" x-data="registerForm()" x-init="init()">

        <h1 class="text-2xl font-bold mb-6 text-center">Cadastro</h1>

        <!-- Mensagens de sucesso/erro -->
        <template x-if="successMessage">
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded" x-text="successMessage"></div>
        </template>

        <template x-if="errorMessage">
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded" x-text="errorMessage"></div>
        </template>

        <form @submit.prevent="submit">
            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Nome</label>
                <input type="text" id="name" x-model="form.name"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium mb-1">Email</label>
                <input type="email" id="email" x-model="form.email"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <label for="password" class="block font-medium mb-1">Senha</label>
                <input type="password" id="password" x-model="form.password"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <!-- Confirmação de Senha -->
            <div class="mb-6">
                <label for="password_confirmation" class="block font-medium mb-1">Confirme a senha</label>
                <input type="password" id="password_confirmation" x-model="form.password_confirmation"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Cadastrar
            </button>
        </form>

    </div>

    <script>
        function registerForm() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                successMessage: '',
                errorMessage: '',
                init() {},
                async submit() {
                    this.successMessage = '';
                    this.errorMessage = '';

                    try {
                        const res = await fetch('{{ route('auth.register') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            // se houver erros de validação, Laravel retorna 422
                            if (data.errors) {
                                this.errorMessage = Object.values(data.errors).flat().join(' ');
                            } else {
                                this.errorMessage = data.message || 'Erro ao cadastrar.';
                            }
                            return;
                        }

                        this.successMessage = data.message || 'Cadastro realizado com sucesso!';
                        this.form.name = '';
                        this.form.email = '';
                        this.form.password = '';
                        this.form.password_confirmation = '';
                    } catch (err) {
                        console.error(err);
                        this.errorMessage = 'Erro ao conectar com o servidor.';
                    }
                }
            }
        }
    </script>

</body>

</html>
