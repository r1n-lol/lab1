@extends('layouts.app')

@section('content')
@php
    $isEdit = $plant->exists;
@endphp
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h1 class="h4 mb-0">{{ $isEdit ? 'Изменить растение' : 'Новое растение' }}</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data"
              action="{{ $isEdit ? route('plants.update', $plant) : route('plants.store') }}">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="name">Название</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $plant->name) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="plant_species_id">Вид</label>
                    <select id="plant_species_id" name="plant_species_id" class="form-select" required>
                        <option value="">Выберите вид</option>
                        @foreach($species as $item)
                            <option value="{{ $item->id }}" @selected(old('plant_species_id', $plant->plant_species_id) == $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="room_id">Помещение</label>
                    <select id="room_id" name="room_id" class="form-select" required>
                        <option value="">Выберите помещение</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" @selected(old('room_id', $plant->room_id) == $room->id)>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="acquired_at">Дата приобретения</label>
                    <input id="acquired_at" name="acquired_at" type="date" class="form-control"
                           value="{{ old('acquired_at', optional($plant->acquired_at)->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="watering_interval">Полив (раз в дней)</label>
                    <input id="watering_interval" name="watering_interval" type="number" min="1" max="60" class="form-control"
                           value="{{ old('watering_interval', $plant->watering_interval) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="condition">Состояние</label>
                    <select id="condition" name="condition" class="form-select" required>
                        @foreach(['Отличное', 'Хорошее', 'Удовлетворительное', 'Требует ухода'] as $condition)
                            <option value="{{ $condition }}" @selected(old('condition', $plant->condition) === $condition)>
                                {{ $condition }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label" for="notes">Заметки</label>
                    <textarea id="notes" name="notes" class="form-control" rows="4">{{ old('notes', $plant->notes) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="photo">Фото</label>
                    <input id="photo" name="photo" type="file" accept="image/*" class="form-control">
                    @if($plant->photo)
                        <img src="{{ asset('storage/' . $plant->photo) }}" class="img-thumbnail mt-2" style="height:100px" alt="Текущее фото">
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">{{ $isEdit ? 'Сохранить' : 'Добавить' }}</button>
                <a href="{{ route('plants.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection
