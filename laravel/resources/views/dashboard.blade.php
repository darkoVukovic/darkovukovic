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
                        @include('partials.exercise-row', ['exercise' => $exercise])
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
                         @include('partials.exercise-row', ['exercise' => $exercise])
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
                        @include('partials.exercise-row', ['exercise' => $exercise])
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
                        @include('partials.exercise-row', ['exercise' => $exercise])
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
                     @include('partials.exercise-row', ['exercise' => $exercise])
                    @endforeach
                @endforeach
                    @endif
                </tbody>
            </table>
            </div>
                <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
             <h1 class="text-center">Subota</h1>
                 <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                @if($saturday && $saturday->count() > 0)
                  @foreach($saturday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                     @include('partials.exercise-row', ['exercise' => $exercise])
                    @endforeach
                @endforeach
                    @endif
                </tbody>
            </table>
            </div>
                 <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
             <h1 class="text-center">Nedelja</h1>
                 <table class="w-full text-left table-auto border-collapse">
                <thead>
                    <tr>
                        <th>Vezba</th>
                        <th>Tezina</th>
                        <th>Ponavljanja</th>
                    </tr>
                </thead>
                <tbody>

                @if($sunday && $sunday->count() > 0)
                  @foreach($sunday as $muscleGroup => $exercises)
                <tr class="font-bold bg-gray-200">
                    <td colspan="3">{{ $muscleGroup }}</td>
                </tr>

                    @foreach($exercises as $exercise)
                     @include('partials.exercise-row', ['exercise' => $exercise])
                    @endforeach
                @endforeach
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        <div class=" h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2>Nedeljni pregled</h2>
            
    <div class="space-y-3">
    @foreach ($weeklyPlans as $plan)
        @php
            $workout = $completed[strtolower($plan->tip_vezbe->naziv)] ?? null;
            $achieved = $workout && $workout->max_tezina >= $plan->goal_weight;
        @endphp

        <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between gap-4" style="background-color: #1a1d2e; border-color: #ff006e;box-shadow: 0 0 15px rgba(255, 0, 110, 0.2)">
            <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-lg" style="color: #f8fafc;">
                    {{ $plan->tip_vezbe->naziv }}
                <span class="inline-block ml-2 px-2 py-0.5 rounded text-xs font-medium" style="background-color: rgba(255, 0, 110, 0.2); color: #ff006e;">
                        {{ $plan->tip_vezbe->muscle_group }}
                    </span>
                </h3>
                
            <div class="mt-2 text-sm space-y-0.5" style="color: #cbd5e1;">
                    <p><strong>Cilj:</strong> {{ number_format($plan->goal_weight, 2) }}kg × {{ $plan->goal_reps }} ponavljanja</p>
                    <p class="text-gray-400"><strong>Planirano:</strong> {{ \Carbon\Carbon::parse($plan->planned_date)->format('d.m.Y') }}</p>
                </div>
            </div>
            
            @if (!$workout)
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700 whitespace-nowrap">
                    Uraditi
                </span>
            @elseif ($achieved)
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 whitespace-nowrap">
                    ✓ Postignuto
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800 whitespace-nowrap">
                    ✗ Nije postignuto
                </span>
            @endif
        </div>
    @endforeach
</div>
        </div>
    </div>
</x-layouts.app>
