<x-layouts.app title="Dodaj novi račun">

           <div class="max-w-2xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Dodaj novi račun</h1>
        </div>
        <div class="bg-gray-800 rounded-lg border-2 border-[#ff006e] p-6">
            <form action="{{ route('accounts.store') }}" method="POST" class="flex flex-col max-w-xl mx-auto w-full p-4 bg-white shadow rounded space-y-4">
                @csrf
                    <!-- Error Summary -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong class="font-bold">Greške:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                <label class="text-white">Naziv Racuna</label>
                <input type="text"      name="name" 
                        placeholder="Tekući račun, Keš, Štednja..." 
                        required >
                <label>Tip Racuna</label>
                <select name="type">
                    <option value="">Izaberi tip</option>
                    <option value="cash">Kes</option>
                    <option value="bank">Bankovni racun</option>
                    <option value="savings">Stednja</option>
                </select>
                 <label>Valuta</label>
                  <select name="currency">
                    <option value="RSD">RSD</option>
                    <option value="EUR">Evro</option>
                </select>
                <label>Pocetni Balans</label>
                <input    type="number" 
                        name="balance" 
                        step="0.01" 
                        value="0" 
                        placeholder="0.00" 
                        required />
            <button 
            type="submit" 
            class="bg-pink-500 px-4 py-6 text-white rounded-xl text-xl">Sacuvaj racun</button>

            </form>


        </div>
    </div>
</x-layouts.app>
