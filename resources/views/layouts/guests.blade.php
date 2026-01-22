<x-app-layout :title="$title ?? 'Consulta de Exámenes'">
    
    @push('styles')
        @endpush

    <div class="min-h-screen flex flex-col">
        
        <x-header />

        <main class="flex-grow container mx-auto px-4 py-8">
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
            <div class="container mx-auto text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Facultad de Ciencias Físico Matemáticas, UANL.</p>
                <p>Ingeniería en Desarrollo de Videojuegos y Medios Interactivos</p>
            </div>
        </footer>

    </div>

</x-app-layout>