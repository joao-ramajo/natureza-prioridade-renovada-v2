<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Pontos de Coleta</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-5xl mx-auto" x-data="collectionPoints()">

    <h1 class="text-3xl font-bold mb-6">Meus Pontos de Coleta</h1>

    <!-- Mensagem de erro -->
    <template x-if="errorMessage">
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded" x-text="errorMessage"></div>
    </template>

    <!-- Loading -->
    <template x-if="loading">
        <div class="text-gray-500 mb-4">Carregando pontos de coleta...</div>
    </template>

    <!-- Lista de pontos -->
    <template x-if="!loading && points.length === 0">
        <div class="text-gray-600">Nenhum ponto de coleta encontrado.</div>
    </template>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-show="points.length > 0">
    <template x-for="point in points" :key="point.id">
        <!-- Card clicável -->
        <div @click="goToPoint(point.id)"
             class="bg-white rounded shadow p-4 cursor-pointer hover:shadow-lg transition">
            <img :src="point.principal_image_url" alt="" class="w-full h-48 object-cover rounded mb-4" />
            <h2 class="text-xl font-bold" x-text="point.name"></h2>
            <p class="mt-1 text-gray-600">Status: <span x-text="point.status"></span></p>
        </div>
    </template>
</div>

</div>

<script>
function collectionPoints() {
    return {
        points: [],
        loading: true,
        errorMessage: '',
        async init() {
            const token = localStorage.getItem('bearer_token');
            if (!token) {
                this.errorMessage = 'Você precisa estar logado.';
                this.loading = false;
                return;
            }

            try {
                const res = await fetch('{{ route("collection_points.list") }}', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();

                if (!res.ok) {
                    this.errorMessage = data.message || 'Erro ao carregar pontos.';
                    this.loading = false;
                    return;
                }

                this.points = data.data.map(p => ({
                    ...p,
                    principal_image_url: p.principal_image ? '/storage/' + p.principal_image : 'https://via.placeholder.com/300x200?text=Sem+Imagem'
                }));

            } catch (err) {
                console.error(err);
                this.errorMessage = 'Erro ao conectar com o servidor.';
            } finally {
                this.loading = false;
            }
        },
        goToPoint(uuid) {
            window.location.href = '{{ url("/ponto-de-coleta") }}/' + uuid;
        }
    }
}
</script>

</body>
</html>
