<x-layouts.app title="Dodaj novu transakciju">

    <div class="max-w-2xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Dodaj novu transakciju</h1>
        </div>

        <div class="bg-gray-800 rounded-lg border-2 border-[#ff006e] p-6">
            <form action="{{ route('transactions.store') }}" method="POST"  class="flex flex-col max-w-xl mx-auto w-full p-4 bg-white shadow rounded space-y-4">
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
                <!-- Account Selection -->
             <label class="text-white">Račun</label>
                <select name="account_id" required>
                    <option value="">Izaberi račun</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">
                            {{ $account->name }} ({{ $account->balance }} {{ $account->currency }})
                        </option>
                    @endforeach
                </select>

             <label class="text-white">Tip</label>
                <select name="type" required>
                    <option value="">Izaberi tip</option>
                    <option value="income">Prihod</option>
                    <option value="expense">Rashod</option>
                </select>
                <!-- Type Selection -->
                <label>Kategorija</label>
                <input type="text" name="category" placeholder="Hrana, Transport, Plata..." required>

                <label>Iznos</label>
                <input     type="number" 
                        name="amount" 
                        step="0.01" 
                        placeholder="0.00" 
                        required >
        
                <label>Valuta</label>
                <select name="currency" required>
                    <option value="RSD">RSD - Dinar</option>
                    <option value="EUR">EUR - Evro</option>
                </select>
                <!-- Currency -->
                <label>Datum</label>
                <input     type="date" 
                        name="date" 
                        value="{{ date('Y-m-d') }}" 
                        required >
                <!-- Date -->
                <label>Opis (opciono)</label>
                <textarea name="description"
                        placeholder="Dodatne informacije..."
                        rows="3"></textarea>
                <!-- Description -->
              
                <!-- Buttons -->
                <div class="flex gap-4 mt-6">
                <button 
                type="submit" 
                class="bg-pink-500 px-4 py-6 text-white rounded-xl text-xl">Sacuvaj transakciju</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
