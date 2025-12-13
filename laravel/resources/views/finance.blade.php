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
                @foreach($balans as $v)
                    <div class="flex justify-between">
                        <span class="text-white">{{$v->name}}</span>
                        <span class="font-semibold text-white">{{number_format($v->balance, 0)}} {{$v->currency}}</span>
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
                <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                    <div>
                        <p class="text-white font-medium">Monster</p>
                        <p class="text-gray-400 text-sm">12.12.2025</p>
                    </div>
                    <span class="text-red-500 font-semibold">-200 RSD</span>
                </div>
                <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                    <div>
                        <p class="text-white font-medium">Monster</p>
                        <p class="text-gray-400 text-sm">12.12.2025</p>
                    </div>
                    <span class="text-red-500 font-semibold">-200 RSD</span>
                </div>
                <!-- repeat -->
            </div>
        </div>
    </div>
    
        
         
</x-layouts.app>

