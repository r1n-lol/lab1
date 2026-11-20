@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Коллекция растений</h1>
    <a href="{{ route('plants.create') }}" class="btn btn-success">Добавить растение</a>
</div>

<div class="row g-3">
    @forelse($plants as $plant)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                @if($plant->photo)
                    <img src="{{ asset('storage/' . $plant->photo) }}" class="card-img-top" style="height:220px;object-fit:cover" alt="{{ $plant->name }}">
                @else
                    <div class="bg-secondary-subtle d-flex align-items-center justify-content-center" style="height:220px">
                        <span class="text-secondary">Фото не добавлено</span>
                    </div>
                @endif
                <div class="card-body">
                    <h2 class="h5 card-title">{{ $plant->name }}</h2>
                    <p class="mb-1"><strong>Вид:</strong> {{ $plant->species->name }}</p>
                    <p class="mb-1"><strong>Помещение:</strong> {{ $plant->room->name }}</p>
                    <p class="mb-3"><strong>Состояние:</strong> {{ $plant->condition }}</p>
                    <a href="{{ route('plants.show', $plant) }}" class="btn btn-outline-success btn-sm">Подробнее</a>
                    <a href="{{ route('plants.edit', $plant) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">В коллекции пока нет растений.</div>
        </div>
    @endforelse
</div>
<div class="mt-4">{{ $plants->links() }}</div>
@endsection
