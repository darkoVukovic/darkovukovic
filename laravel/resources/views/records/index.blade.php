<x-layouts.app title="Rekordi (PR)">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Lični rekordi 🏆</h1>
        
        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('records') }}" method="GET">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Pretraži vežbe..." 
                        class="flex-1 bg-gray-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#ff006e]"
                    >
                    <button 
                        type="submit" 
                        class="bg-[#ff006e] hover:bg-[#cc0058] text-white px-6 py-2 rounded-lg"
                    >
                        🔍 Pretraži
                    </button>
                    @if(request('search'))
                        <a 
                            href="{{ route('records') }}" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg"
                        >
                            ✖ Očisti
                        </a>
                    @endif
                </div>
            </form>
        </div>
        
        <div class="grid gap-4">
            @forelse($records as $record)
                <div class="bg-gray-800 border-2 border-[#ff006e] rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $record->tip_vezbe->naziv }}</h3>
                            <p class="text-gray-400 text-sm">{{ $record->tip_vezbe->muscle_group }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-4xl font-bold text-[#ff006e]">{{ $record->personal_record }} kg</p>
                            <p class="text-gray-400 text-sm">Lični rekord</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center">
                    @if(request('search'))
                        Nema rezultata za "{{ request('search') }}"
                    @else
                        Nemate još rekorda. Dodajte vežbe!
                    @endif
                </p>
            @endforelse
        </div>
    </div>
</x-layouts.app>