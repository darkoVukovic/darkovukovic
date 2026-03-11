@if($exercises->count() > 0)
<div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <h1 class="text-center">{{ $dayName }}</h1>
    <table class="w-full text-left table-auto border-collapse">
        <thead>
            <tr>
                <th class="py-2 text-blue-500! text-left px-4 text-sm sm:text-base">Vezba</th>
                <th class="py-2 text-red-500! text-center px-4 text-sm sm:text-base">Tezina</th>
                <th class="py-2 text-green-500! text-center px-4 text-sm sm:text-base">Ponavljanja</th>
                <th class="py-2 px-4"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($exercises as $muscleGroup => $items)
                <tr class="font-bold bg-gray-200">
                    <td class="text-pink-500!" colspan="4">{{ $muscleGroup }}</td>
                </tr>
                @foreach($items as $exercise)
                    @include('partials.exercise-row', ['exercise' => $exercise])
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endif