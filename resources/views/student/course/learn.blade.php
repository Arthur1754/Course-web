@extends('layouts.student.app')

@section('content')
<div class="container-fluid px-0">
    
    <div class="bg-dark text-white p-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-light btn-sm rounded-circle me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h6 class="mb-0 fw-bold">{{ $course->name }}</h6>
                <small class="text-white-50">Instructor: {{ $course->instructor->name }}</small>
            </div>
        </div>
        <div class="d-none d-md-block">
            <div class="progress" style="width: 150px; height: 8px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
            </div>
            <small class="text-white-50 extra-small">0% Komplit</small>
        </div>
    </div>

    <div class="row g-0" style="min-height: 85vh;">
        
        <div class="col-lg-8 bg-black d-flex flex-column justify-content-center align-items-center position-relative">
            
            @if($currentLesson)
                <div class="ratio ratio-16x9 w-100" style="max-height: 80vh;">
                    {{-- Ganti Logic iframe ini sesuai penyimpanan video Anda (Youtube/Local) --}}
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe>
                </div>
                
                <div class="w-100 bg-white p-4">
                    <h4 class="fw-bold">{{ $currentLesson->title }}</h4>
                    <p class="text-muted">{{ $currentLesson->description ?? 'Tidak ada deskripsi untuk materi ini.' }}</p>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-outline-secondary rounded-pill px-4" disabled>
                            <i class="fas fa-step-backward me-2"></i> Sebelumnya
                        </button>
                        <button class="btn btn-primary rounded-pill px-4">
                            Selanjutnya <i class="fas fa-step-forward ms-2"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="text-white text-center">
                    <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                    <p>Belum ada materi yang diunggah.</p>
                </div>
            @endif

        </div>

        <div class="col-lg-4 bg-white border-start overflow-auto" style="height: 85vh;">
            <div class="p-3 border-bottom bg-light sticky-top">
                <h6 class="fw-bold mb-0">Konten Kursus</h6>
            </div>

            <div class="accordion accordion-flush" id="accordionCurriculum">
                @foreach($course->chapters as $index => $chapter)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#chapter-{{ $chapter->id }}">
                            Bagian {{ $index + 1 }}: {{ $chapter->title }}
                        </button>
                    </h2>
                    <div id="chapter-{{ $chapter->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#accordionCurriculum">
                        <div class="accordion-body p-0">
                            <ul class="list-group list-group-flush">
                                @foreach($chapter->lessons as $lesson)
                                    <li class="list-group-item list-group-item-action d-flex align-items-center py-3 {{ (isset($currentLesson) && $currentLesson->id == $lesson->id) ? 'bg-primary bg-opacity-10 border-start border-4 border-primary' : '' }}" style="cursor: pointer;">
                                        
                                        <div class="me-3">
                                            <i class="far fa-circle text-muted"></i>
                                            {{-- Jika selesai ganti icon: <i class="fas fa-check-circle text-success"></i> --}}
                                        </div>
                                        
                                        <div class="flex-grow-1">
                                            <span class="d-block small fw-bold {{ (isset($currentLesson) && $currentLesson->id == $lesson->id) ? 'text-primary' : 'text-dark' }}">
                                                {{ $lesson->title }}
                                            </span>
                                            <span class="d-block extra-small text-muted">
                                                <i class="fas fa-play-circle me-1"></i> Video • 10 Min
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
    /* Hilangkan padding default container main agar full width */
    main { padding-top: 0 !important; padding-bottom: 0 !important; }
    
    /* Scrollbar cantik untuk playlist */
    .overflow-auto::-webkit-scrollbar { width: 6px; }
    .overflow-auto::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
</style>
@endsection