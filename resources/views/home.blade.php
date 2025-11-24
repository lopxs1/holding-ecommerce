@extends('layouts.app')

@section('content')
<div class="bg-light">
    {{-- Hero --}}
    <section class="position-relative overflow-hidden rounded-3 my-4 p-5 p-lg-5" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7);">
        <div class="row align-items-center text-white">
            <div class="col-lg-7">
                <p class="text-uppercase fw-semibold mb-2">GLF Imobiliaria</p>
                <h1 class="display-5 fw-bold mb-3">Encontre o seu proximo lar com rapidez e clareza.</h1>
                <p class="lead mb-4">Selecao de imoveis com fotos, valores transparentes e acompanhamento do seu pedido em tempo real.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('holdings.index') }}" class="btn btn-light text-primary fw-semibold px-4 py-2">
                        Ver imoveis
                    </a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light fw-semibold px-4 py-2">
                            Meus pedidos
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-light fw-semibold px-4 py-2">
                            Criar conta
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <div class="bg-white text-dark rounded-4 shadow p-4">
                    <p class="fw-bold mb-1">Buscar por perfil</p>
                    <p class="text-muted small mb-3">Apartamentos, casas e salas comerciais</p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100">
                                <i class="fa-solid fa-building fa-2x text-primary mb-2"></i>
                                <p class="mb-0 fw-semibold">Urbanos</p>
                                <small class="text-muted">Localizacao central</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100">
                                <i class="fa-solid fa-tree-city fa-2x text-primary mb-2"></i>
                                <p class="mb-0 fw-semibold">Condominios</p>
                                <small class="text-muted">Seguranca e lazer</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100">
                                <i class="fa-solid fa-briefcase fa-2x text-primary mb-2"></i>
                                <p class="mb-0 fw-semibold">Comerciais</p>
                                <small class="text-muted">Para o seu negocio</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100">
                                <i class="fa-solid fa-leaf fa-2x text-primary mb-2"></i>
                                <p class="mb-0 fw-semibold">Terrenos</p>
                                <small class="text-muted">Construa do seu jeito</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('holdings.index') }}" class="btn btn-primary w-100">Explorar catalogo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Destaques --}}
    <section class="my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3 text-primary fs-3"><i class="fa-solid fa-bolt"></i></span>
                            <h5 class="card-title mb-0">Processo rapido</h5>
                        </div>
                        <p class="card-text text-muted">Cadastre-se, escolha o imovel e acompanhe cada etapa ate concluir a compra.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3 text-primary fs-3"><i class="fa-solid fa-shield-halved"></i></span>
                            <h5 class="card-title mb-0">Transparencia</h5>
                        </div>
                        <p class="card-text text-muted">Valores claros, documentos organizados e comunicacao direta com a equipe.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3 text-primary fs-3"><i class="fa-solid fa-handshake"></i></span>
                            <h5 class="card-title mb-0">Atendimento proximo</h5>
                        </div>
                        <p class="card-text text-muted">Equipe dedicada para tirar duvidas e ajudar na escolha do melhor imovel.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
