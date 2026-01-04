@extends('layouts.admin.dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>
        </div>

        @if($courses->isEmpty())
        <div class="alert alert-info">
            Anda belum memiliki kursus atau siswa yang terdaftar.
        </div>
        @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Siswa di Kursus Anda</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>Kursus</th>
                                <th>Progress</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                @foreach($course->students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $student->pivot->progress }}%"
                                                aria-valuenow="{{ $student->pivot->progress }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $student->pivot->progress }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $student->pivot->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $student->pivot->status == 'active' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($student->pivot->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
