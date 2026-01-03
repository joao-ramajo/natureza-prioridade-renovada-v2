<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow-md w-full max-w-md"
     x-data="loginForm()">

    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    <!-- Mensagens de sucesso/erro -->
    <template x-if="successMessage">
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded" x-text="successMessage"></div>
    </template>

    <template x-if="errorMessage">
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded" x-text="errorMessage"></div>
    </template>

    <form @submit.prevent="submit">
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium mb-1">Email</label>
            <input type="email" id="email" x-model="form.email"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <!-- Senha -->
        <div class="mb-6">
            <label for="password" class="block font-medium mb-1">Senha</label>
            <input type="password" id="password" x-model="form.password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
            Entrar
        </button>
    </form>

</div>

<script>
function loginForm() {
    return {
        form: {
            email: '',
            password: ''
        },
        successMessage: '',
        errorMessage: '',
        async submit() {
            this.successMessage = '';
            this.errorMessage = '';

            try {
                const res = await fetch('{{ route("auth.login") }}', {
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
                    if (data.errors) {
                        this.errorMessage = Object.values(data.errors).flat().join(' ');
                    } else {
                        this.errorMessage = data.message || 'Erro ao logar.';
                    }
                    return;
                }

                // ✅ Salvar Bearer token no localStorage
                let token =  data.access_token;
                localStorage.setItem('bearer_token', token);

                if(!token){
                    this.errorMessage = 'Token inválido para salvar'
                    return
                }
                console.log(data.access_token);

                this.successMessage = 'Login realizado com sucesso!';
                this.form.email = '';
                this.form.password = '';

                // 🔹 Redirecionar para route('web.home')
                window.location.href = '{{ route("web.home") }}';

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
