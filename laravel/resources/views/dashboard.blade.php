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
                    @if($monday->count() > 0)
               @foreach($monday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{ $exercise->tipVezbe->naziv }}</td>
                        <td>{{ $exercise->max_tezina }}</td>
                        <td>{{ $exercise->ponavljanja }}</td>
                    </tr>
                    @endforeach
                @endforeach
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

                    @if($tuesday && $tuesday->count() > 0)
                     @foreach($tuesday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{ $exercise->tipVezbe->naziv }}</td>
                        <td>{{ $exercise->max_tezina }}</td>
                        <td>{{ $exercise->ponavljanja }}</td>
                    </tr>
                    @endforeach
                @endforeach
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

                @if($wednesday && $wednesday->count() > 0)
                  @foreach($wednesday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{ $exercise->tipVezbe->naziv }}</td>
                        <td>{{ $exercise->max_tezina }}</td>
                        <td>{{ $exercise->ponavljanja }}</td>
                    </tr>
                    @endforeach
                @endforeach
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

                @if($thursday && $thursday->count() > 0)
                @foreach($thursday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{ $exercise->tipVezbe->naziv }}</td>
                        <td>{{ $exercise->max_tezina }}</td>
                        <td>{{ $exercise->ponavljanja }}</td>
                    </tr>
                    @endforeach
                @endforeach
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

                @if($friday && $friday->count() > 0)
                  @foreach($friday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                    <tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
                        <td>{{ $exercise->tipVezbe->naziv }}</td>
                        <td>{{ $exercise->max_tezina }}</td>
                        <td>{{ $exercise->ponavljanja }}</td>
                    </tr>
                    @endforeach
                @endforeach
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
            
        </tbody>
    </table>
        </div>
    </div>
</x-layouts.app>
