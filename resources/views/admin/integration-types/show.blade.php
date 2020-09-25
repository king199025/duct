<?php /**@var \App\Models\Integrations\IntegrationType $type */ ?>

@extends('layouts.admin')

@section('content')

    <a href="{{ route('integration-types.index') }}" class="btn btn-success mb-3">Назад к списку</a>

    <table class="table table-bordered table stripped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $type->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $type->title }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $type->slug }}</td>
        </tr>
        <tr>
            <th>Fields</th>
            <td>{{ $type->getOriginal('fields') }}</td>
        </tr>
        <tr>
            <th>Options</th>
            <td>{{ $type->getOriginal('options') }}</td>
        </tr>

        <tr>
            <th>Url</th>
            <td>{{ $type->url }}</td>
        </tr>
        </tbody>
    </table>

@endsection
