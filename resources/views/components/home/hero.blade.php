{{-- Hero Section com Animação de Fundo Neural --}}
{{-- Altura ajustada para min-h-screen --}}
<section {{ $attributes->merge(['class' => 'relative bg-[#171717] text-white min-h-screen flex items-center justify-center overflow-hidden py-20 md:py-32']) }}>

    {{-- Canvas para a Animação --}}
    <canvas id="neuralNetworkCanvas" class="absolute inset-0 z-0 opacity-40"></canvas>

    {{-- Conteúdo Central --}}
    <div class="relative container mx-auto px-6 text-center z-10">
        {{-- Texto Principal Refinado --}}
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-5 leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
            Inteligência de Dados <span class="text-[#ed1c24]">CNPJ</span>
        </h1>
        {{-- Texto Secundário Refinado e Menor --}}
        <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto font-light animate-fade-in-up" style="animation-delay: 0.4s;">
            Navegue pela rede empresarial, filtre <strong class="font-semibold text-white">potenciais clientes B2B</strong> por localização, CNAE e mais. Dados para sua prospecção.
        </p>

        {{-- Botão Principal --}}
        <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
            <a href="{{ route('portal.index') }}"
               class="inline-block bg-[#ed1c24] text-white font-bold py-3 px-10 rounded-full text-lg hover:bg-[#c11b21] transition-all transform hover:scale-105 duration-300 shadow-lg group relative overflow-hidden">
                <span class="relative z-10 transition-transform duration-300 group-hover:-translate-y-px">
                    Explorar Portal
                </span>
                <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 group-hover:opacity-10"></span>
                <i class="bi bi-arrow-right ml-2 relative z-10 transition-transform duration-300 group-hover:translate-x-1"></i>
            </a>
        </div>

    </div>
</section>

{{-- Adiciona o JavaScript e CSS para a Animação do Canvas --}}
@pushOnce('styles')
<style>
    #neuralNetworkCanvas {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }
    /* Animação de Fade-in para o texto */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        opacity: 0; /* Começa invisível */
        animation: fadeInUp 0.8s ease-out forwards;
    }
</style>
@endPushOnce

@pushOnce('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('neuralNetworkCanvas');
        if (!canvas) return; // Sai se o canvas não existir

        const ctx = canvas.getContext('2d');
        let width = canvas.offsetWidth;
        let height = canvas.offsetHeight;
        canvas.width = width;
        canvas.height = height;

        const particles = [];
        // Densidade AUMENTADA (divisor menor) para mais partículas
        const particleCount = Math.floor((width * height) / 9000); // <-- AJUSTADO
        const maxDistance = 110; // Distância levemente reduzida para compensar densidade
        const particleSpeed = 0.3; // Velocidade levemente reduzida
        const lineColor = 'rgba(237, 28, 36, 0.35)'; // Cor das linhas (#ed1c24 com opacidade ajustada)
        const particleColor = 'rgba(237, 28, 36, 0.5)'; // Cor das partículas ajustada

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * particleSpeed;
                this.vy = (Math.random() - 0.5) * particleSpeed;
                this.radius = Math.random() * 1.2 + 3; // Tamanho levemente ajustado
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Mantém as partículas dentro do canvas
                if (this.x < this.radius || this.x > width - this.radius) this.vx *= -1;
                if (this.y < this.radius || this.y > height - this.radius) this.vy *= -1;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = particleColor;
                ctx.fill();
            }
        }

        function init() {
            particles.length = 0; // Limpa array antes de recriar
            width = canvas.offsetWidth; // Atualiza dimensões
            height = canvas.offsetHeight;
            canvas.width = width;
            canvas.height = height;
            // Recalcula a contagem baseada nas novas dimensões
            const newParticleCount = Math.floor((width * height) / 9000); // <-- AJUSTADO
            for (let i = 0; i < newParticleCount; i++) {
                particles.push(new Particle());
            }
        }

        function connectParticles() {
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < maxDistance) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        // A opacidade da linha diminui com a distância
                        ctx.strokeStyle = `rgba(237, 28, 36, ${0.8 * (1 - distance / maxDistance)})`; // Opacidade ajustada
                        ctx.lineWidth = 0.4; // Linhas bem finas
                        ctx.stroke();
                    }
                }
            }
        }

        function animate() {
            // Otimização: Só limpa se houver partículas (evita limpar tela vazia)
             if (particles.length > 0) {
                 ctx.clearRect(0, 0, width, height);
             }

            particles.forEach(particle => {
                particle.update();
                // Otimização: Só desenha se estiver visível (menos relevante aqui, mas boa prática)
                // if (particle.x > -particle.radius && particle.x < width + particle.radius &&
                //     particle.y > -particle.radius && particle.y < height + particle.radius) {
                     particle.draw();
                // }
            });

            connectParticles();

            requestAnimationFrame(animate); // Chama o próximo frame
        }

        // --- Inicialização e Responsividade ---
        init(); // Cria as partículas iniciais
        animate(); // Inicia a animação

        // Recalcula ao redimensionar a janela (com debounce para performance)
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(init, 300); // Aumenta um pouco o debounce
        });
    });
</script>
@endPushOnce

