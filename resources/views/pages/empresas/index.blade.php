@extends('layouts.app')


@section('content')
<div class="bg-white mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="mt-16">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16">
            <div class="lg:col-span-1">
            </div>
            <div class="lg:col-span-1">
            </div>
        </div>
        <div class="mt-16">
        </div>
        <div class="mt-16">
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-16">
            <div>
                <x-empresas.stats-abertas-fechadas :abertas="$statsAbertas" :fechadas="$statsFechadas" />
            </div>
        </div>
    </div>
</div>
@endsection

