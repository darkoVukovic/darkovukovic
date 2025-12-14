<div class="fixed top-4 right-4 z-50 space-y-2">
    @if(session('success'))
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif
</div>
<x-layouts.app :title="__('Dashboard')">
    <div class="my-5">
        <div class="flex justify-between items-center mb-6">
    <div class="flex gap-2">
        <a href="{{ route('transactions.create') }}" class="bg-[#ff006e] hover:bg-[#cc0058] text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <span>+</span> Dodaj transakciju
        </a>
        <a href="{{ route('accounts.create') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <span>+</span> Dodaj račun
        </a>
    </div>
</div>
    </div>
    <!-- finance/index.blade.php -->

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl"> 
            <h1 class="text-center text-3xl">Finansije {{$vreme}}</h1>

    <hr />
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
            <!-- Ukupan Balans Card -->
            <div class="bg-gray-800 rounded-lg p-6 border-2 border-[#ff006e]">
                <h3 class="text-gray-400 text-sm mb-2">Ukupan balans</h3>
                @foreach($totalsByCurrency as $currency => $total)
                    <p>{{ number_format($total, 0) }} {{ $currency }}</p>
                @endforeach
            </div>
            
            <!-- Računi Card -->
            <div class="bg-gray-800 rounded-lg border-2 border-[#ff006e] p-6 md:col-span-2">
                <h3 class="text-gray-400 text-sm mb-4">Računi</h3>
                <div class="space-y-3">
                @foreach($balans as $account)
                <div class="flex justify-between items-center hover:bg-[#3D2B3E] p-2 rounded transition">
                    <span class="text-white">{{ $account->name }}</span>
                    <div class="flex items-center gap-3">
                        <span class="font-semibold text-blue-500">
                            {{ number_format($account->balance, 2) }} {{ $account->currency }}
                        </span>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('accounts.destroy', $account) }}" method="POST" 
                            onsubmit="return confirm('Da li ste sigurni? Ovo će obrisati račun i sve transakcije!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                🗑️
                            </button>
                        </form>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

        <!-- Ovaj mesec -->
        <div class="bg-gray-800 rounded-lg p-6 mt-6 border-2 border-[#ff006e]">
            <h3 class="text-gray-400 text-sm mb-4">Ovaj mesec</h3>
            <div class="grid grid-cols-3 gap-4">
                    <div>
                    <p class="text-gray-400 text-sm">Prihodi</p>

                    @foreach($totalsByIncome['income'] ?? [] as $currency => $total)
                        <p class="text-2xl font-bold text-green-500">
                            +{{ number_format($total, 0) }} {{ $currency }}
                        </p>
                    @endforeach
                </div>
                 <div>
                    <p class="text-gray-400 text-sm">Rashodi</p>

                    @foreach($totalsByIncome['expense'] ?? [] as $currency => $total)
                        <p class="text-2xl font-bold text-red-500">
                            -{{ number_format($total, 0) }} {{ $currency }}
                        </p>
                    @endforeach
                </div>
                <div>
        <p class="text-gray-400 text-sm">Razlika</p>
        @foreach($diffs ?? [] as $currency => $diff)
            <p class="text-2xl font-bold {{$diff >= 0 ? 'text-blue-500' : 'text-red-500'}}">
                {{ $diff >= 0 ? '+' : '-' }}{{ number_format(abs($diff), 0) }} {{ $currency }}
            </p>
        @endforeach
    </div>
            </div>
        </div>

        <!-- Transakcije -->
        <div class="bg-gray-800  rounded-lg p-6 mt-6">
            <h3 class="text-gray-400 text-sm mb-4">Poslednje Transakcije</h3>
            <div class="space-y-3">
                @foreach($transactionsPaginate as $v) 
            <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                <div>
                    <p class="text-white font-medium">{{ $v->description }}</p>
                    <p class="text-gray-400 text-sm">{{ $v->created_at }}</p>
                </div>
                        <div class="flex items-center gap-4">

                <span class="{{ $v->type == 'income' ? 'text-green-500' : 'text-red-500' }} font-semibold">
                    {{ $v->type == 'income' ? '+' : '-' }} {{ number_format($v->amount, 0) }} {{$v->currency}}
                </span>
                 <form action="{{ route('transactions.destroy', $v) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu transakciju?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                    Obriši
                </button>
            </form>
        </div>
            </div>
        @endforeach
            </div>
             <div class="mt-4">
        {{ $transactionsPaginate->links() }}
    </div>
        </div>
    </div>
    
        
         
</x-layouts.app>

