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
        </div>
        <div class=" h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2>Nedeljni pregled</h2>
         @foreach ($weeklyPlans as $plan)
    @php
        $workout = $completed[$plan->tip_vezbe->naziv] ?? null;

        $achieved = $workout && $workout->max_tezina >= $plan->goal_weight;
    @endphp
    <div>
        {{ $plan->tip_vezbe->naziv }} ({{ $plan->tip_vezbe->muscle_group }}) — 
        Cilj: {{ number_format($plan->goal_weight, 2) }}kg × {{ $plan->goal_reps }} ponavljanja:
        planiran datum rada: {{ $plan->planned_date }}
        @if (!$workout)
            <span style="color: gray;">[Pending]</span>
        @elseif ($achieved)
            <span style="color: green;">✔</span>
        @else
            <span style="color: red;">✖</span>
        @endif
       <hr class="m-2" >
    </div>
@endforeach
        </div>
    </div>
</x-layouts.app>
