<x-layouts.app :title="__('Dashboard')">
    <div class="my-5">
            <h3 class="text-center">{{$vreme}}</h3>

    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h1 class="text-center">Ponedeljak</h1>
            <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                    @if($monday)
                
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{$monday->tip_vezbe}}</td>
                        <td>{{$monday->max_tezina}}</td>
                        <td>{{$monday->ponavljanja}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
            <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h1 class="text-center">Utorak</h1>
              <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                    @if($tuesday)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{$tuesday->tip_vezbe}}</td>
                        <td>{{$tuesday->max_tezina}}</td>
                        <td>{{$tuesday->ponavljanja}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
            <div class=" overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h1 class="text-center">Sreda</h1>
              <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                    @if($wednesday)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{$wednesday->tip_vezbe}}</td>
                        <td>{{$wednesday->max_tezina}}</td>
                        <td>{{$wednesday->ponavljanja}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
             <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h1 class="text-center">Cetvrtak</h1>
                <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                    @if($thursday)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{$thursday->tip_vezbe}}</td>
                        <td>{{$thursday->max_tezina}}</td>
                        <td>{{$thursday->ponavljanja}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
             <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
             <h1 class="text-center">Petak</h1>
                 <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                    @if($friday)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{$friday->tip_vezbe}}</td>
                        <td>{{$friday->max_tezina}}</td>
                        <td>{{$friday->ponavljanja}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        <div class=" h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2>Nedeljni pregled</h2>
                <table class="w-full text-left table-auto border-collapse">
        <thead>
            <tr class="bg-neutral-100 dark:bg-neutral-700">
                <th class="border px-2 py-1">Dan</th>
                <th class="border px-2 py-1">Vezba</th>
                <th class="border px-2 py-1">Tezina (kg)</th>
                <th class="border px-2 py-1">Ponavljanja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($weekSummary as $item)
                <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                    <td class="border px-2 py-1">{{ $item->Dan }}</td>
                    <td class="border px-2 py-1">{{ $item->tip_vezbe }}</td>
                    <td class="border px-2 py-1">{{ $item->max_tezina }}</td>
                    <td class="border px-2 py-1">{{ $item->ponavljanja }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</x-layouts.app>
