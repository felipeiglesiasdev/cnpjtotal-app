import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

function cnaeSearch() {
    return {
        query: '',
        results: [],
        loading: false,
        open: false,
        
        fetchResults() {
            // O Controller já trata < 2, mas evitamos chamadas desnecessárias
            if (this.query.length < 2) {
                this.results = [];
                this.loading = false;
                this.open = this.query.length > 0; // Mantém aberto se focado
                return;
            }
            
            this.loading = true;
            this.open = true;

            fetch(`{{ route('cnae.search') }}?q=${this.query}`)
                .then(response => response.json())
                .then(data => {
                    this.results = data;
                    this.loading = false;
                })
                .catch(error => {
                    console.error('Erro ao buscar CNAEs:', error);
                    this.loading = false;
                    this.open = false;
                });
        }
    }
}
