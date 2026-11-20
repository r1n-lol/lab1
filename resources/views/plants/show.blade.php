@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="row g-0">
        <div class="col-md-5">
            @if($plant->photo)
                <img src="{{ asset('storage/' . $plant->photo) }}" class="img-fluid rounded-start w-100" style="height:100%;max-height:420px;object-fit:cover" alt="{{ $plant->name }}">
            @else
                <div class="bg-secondary-subtle d-flex align-items-center justify-content-center" style="min-height:320px">
                    <span class="text-secondary">Фото не добавлено</span>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body p-4">
                <h1 class="h3">{{ $plant->name }}</h1>
                <dl class="row mt-4">
                    <dt class="col-sm-5">Вид</dt><dd class="col-sm-7">{{ $plant->species->name }}</dd>
                    <dt class="col-sm-5">Помещение</dt><dd class="col-sm-7">{{ $plant->room->name }}</dd>
                    <dt class="col-sm-5">Дата приобретения</dt><dd class="col-sm-7">{{ $plant->acquired_at->format('d.m.Y') }}</dd>
                    <dt class="col-sm-5">Интервал полива</dt><dd class="col-sm-7">Раз в {{ $plant->watering_interval }} дн.</dd>
                    <dt class="col-sm-5">Состояние</dt><dd class="col-sm-7">{{ $plant->condition }}</dd>
                    <dt class="col-sm-5">Заметки</dt><dd class="col-sm-7">{{ $plant->notes ?: 'Нет заметок' }}</dd>
                </dl>
                <a href="{{ route('plants.edit', $plant) }}" class="btn btn-primary">Изменить</a>
                <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Удалить это растение?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
                <a href="{{ route('plants.index') }}" class="btn btn-secondary">Назад</a>
            </div>
        </div>
    </div>
</div>
@endsection
