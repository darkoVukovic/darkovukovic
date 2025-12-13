<x-layouts.app title="Dodaj novu transakciju">

    <div class="max-w-2xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Dodaj novu transakciju</h1>
        </div>

        <div class="bg-gray-800 rounded-lg border-2 border-[#ff006e] p-6">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <!-- Account Selection -->
                <flux:field>
                    <flux:label>Račun</flux:label>
                    <flux:select name="account_id" required>
                        <option value="">Izaberi račun</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">
                                {{ $account->name }} ({{ $account->balance }} {{ $account->currency }})
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="account_id" />
                </flux:field>

                <!-- Type Selection -->
                <flux:field>
                    <flux:label>Tip</flux:label>
                    <flux:select name="type" required>
                        <option value="">Izaberi tip</option>
                        <option value="income">Prihod</option>
                        <option value="expense">Rashod</option>
                        <option value="transfer">Transfer</option>
                    </flux:select>
                    <flux:error name="type" />
                </flux:field>

                <!-- Category -->
                <flux:field>
                    <flux:label>Kategorija</flux:label>
                    <flux:input name="category" placeholder="Hrana, Transport, Plata..." required />
                    <flux:error name="category" />
                </flux:field>

                <!-- Amount -->
                <flux:field>
                    <flux:label>Iznos</flux:label>
                    <flux:input 
                        type="number" 
                        name="amount" 
                        step="0.01" 
                        placeholder="0.00" 
                        required 
                    />
                    <flux:error name="amount" />
                </flux:field>

                <!-- Currency -->
                <flux:field>
                    <flux:label>Valuta</flux:label>
                    <flux:select name="currency" required>
                        <option value="RSD">RSD - Dinar</option>
                        <option value="EUR">EUR - Evro</option>
                    </flux:select>
                    <flux:error name="currency" />
                </flux:field>

                <!-- Date -->
                <flux:field>
                    <flux:label>Datum</flux:label>
                    <flux:input 
                        type="date" 
                        name="date" 
                        value="{{ date('Y-m-d') }}" 
                        required 
                    />
                    <flux:error name="date" />
                </flux:field>

                <!-- Description -->
                <flux:field>
                    <flux:label>Opis (opciono)</flux:label>
                    <flux:textarea 
                        name="description" 
                        placeholder="Dodatne informacije..."
                        rows="3"
                    />
                    <flux:error name="description" />
                </flux:field>

                <!-- Buttons -->
                <div class="flex gap-4 mt-6">
                    <flux:button type="submit" class="bg-[#ff006e] hover:bg-[#cc0058]">
                        Sačuvaj transakciju
                    </flux:button>
                    <flux:button 
                        variant="ghost" 
                        href="{{ route('finance') }}"
                    >
                        Otkaži
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
