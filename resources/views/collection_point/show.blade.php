<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do Ponto de Coleta</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md" x-data="collectionPointDetails('{{ $uuid }}')" x-init="init()">

        <!-- Mensagem de erro/sucesso -->
        <template x-if="errorMessage">
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded" x-text="errorMessage"></div>
        </template>

        <template x-if="successMessage">
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded" x-text="successMessage"></div>
        </template>

        <!-- Loading -->
        <template x-if="loading">
            <div class="text-gray-500 mb-4">Carregando detalhes do ponto...</div>
        </template>

        <!-- Detalhes do ponto -->
        <template x-if="!loading && point">
            <div>
                <h1 class="text-2xl font-bold mb-4" x-text="point.name"></h1>

                <img :src="point.principal_image_url" alt="" class="w-full h-64 object-cover rounded mb-4" />

                <div class="mb-2"><strong>Categoria:</strong> <span x-text="point.category"></span></div>
                <div class="mb-2"><strong>Status:</strong> <span x-text="point.status"></span></div>
                <div class="mb-2"><strong>Endereço:</strong> <span
                        x-text="point.address + ', ' + point.city + ' - ' + point.state"></span></div>
                <div class="mb-2"><strong>Criado por:</strong> <span
                        x-text="point.created_by.name + ' (' + point.created_by.email + ')'"></span></div>
                <div class="mb-2"><strong>Criado em:</strong> <span x-text="point.created_at"></span></div>
                <div class="mb-2"><strong>Última atualização:</strong> <span x-text="point.updated_at"></span></div>


                <!-- Campos de reprovação -->
                <template x-if="point.rejected_at && point.rejection_reason">
                    <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded">
                        <div class="mb-2"><strong>Reprovado em:</strong> <span x-text="point.rejected_at"></span>
                        </div>
                        <div class="mb-2"><strong>Motivo:</strong> <span x-text="point.rejection_reason"></span></div>
                    </div>
                </template>
                <!-- Botões de ação -->
                <div class="mt-6 flex space-x-4">
                    <button @click="approve"
                        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition">
                        Aprovar
                    </button>

                    <button @click="reprove"
                        class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition">
                        Reprovar
                    </button>
                </div>
            </div>
        </template>

    </div>

    <script>
        function collectionPointDetails(uuid) {
            return {
                point: null,
                loading: true,
                errorMessage: '',
                successMessage: '',
                async init() {
                    const token = localStorage.getItem('bearer_token');
                    if (!token) {
                        this.errorMessage = 'Você precisa estar logado.';
                        this.loading = false;
                        return;
                    }

                    try {
                        const res = await fetch('/api/collection-points/' + uuid, {
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            this.errorMessage = data.message || 'Erro ao carregar ponto.';
                            this.loading = false;
                            return;
                        }

                        this.point = data.data;
                        this.point.principal_image_url = this.point.principal_image ? '/storage/' + this.point
                            .principal_image : 'https://via.placeholder.com/500x300?text=Sem+Imagem';

                    } catch (err) {
                        console.error(err);
                        this.errorMessage = 'Erro ao conectar com o servidor.';
                    } finally {
                        this.loading = false;
                    }
                },

                async approve() {
                    this.errorMessage = '';
                    this.successMessage = '';
                    const token = localStorage.getItem('bearer_token');
                    if (!token) return this.errorMessage = 'Você precisa estar logado.';

                    try {
                        const res = await fetch('/api/collection-points/approve/' + this.point.id, {
                            method: 'PUT',
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            this.errorMessage = data.message || 'Erro ao aprovar ponto.';
                            return;
                        }

                        this.successMessage = 'Ponto aprovado com sucesso!';
                        this.point.status = 'aprovado';

                    } catch (err) {
                        console.error(err);
                        this.errorMessage = 'Erro ao conectar com o servidor.';
                    }
                },

                async reprove() {
                    this.errorMessage = '';
                    this.successMessage = '';
                    const token = localStorage.getItem('bearer_token');
                    if (!token) return this.errorMessage = 'Você precisa estar logado.';

                    // Para reprovar, podemos pedir um motivo simples via prompt
                    const reason = prompt('Informe o motivo da reprovação:');
                    if (!reason) return;

                    try {
                        const res = await fetch('/api/collection-points/reprove/' + this.point.id, {
                            method: 'PUT',
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                reason
                            })
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            this.errorMessage = data.message || 'Erro ao reprovar ponto.';
                            return;
                        }

                        this.successMessage = 'Ponto reprovado com sucesso!';
                        this.point.status = 'reprovado';

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
