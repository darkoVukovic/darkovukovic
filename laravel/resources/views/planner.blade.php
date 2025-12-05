<x-layouts.app :title="__('Dashboard')">
    <div class="my-5">

    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl"> 
            <h1 class="text-center text-3xl">Planer {{$vreme}}</h1>

   <form action="{{ route('planner.store') }}" method="POST" class="flex flex-col max-w-xl mx-auto w-full p-4 bg-white shadow rounded space-y-4" >
    @csrf

    <label>Vezba:</label>
    <select name="tip_vezbe_id" id="exerciseSelect">
        <option value="">-- Izaberi vezbu --</option>
        @foreach($exercises as $ex)
            <option value="{{ $ex->id }}">{{ $ex->naziv }} ({{ $ex->muscle_group }})</option>
        @endforeach
    </select>
    <label>Goal weight:</label>
    <input  class="input-underline" type="number" step="0.5" name="goal_weight" id="goalWeight" required>

    <label>Goal reps:</label>
    <input  class="input-underline" type="number" name="goal_reps" value="" required>

    <label>Date:</label>
    <input  class="input-underline" type="date" name="planned_date" value="{{ now()->toDateString() }}">
    <p id="lastMax" class="text-white text-xl text-center">Rekord za vezbu</p>
    <button type="submit" class="bg-pink-500 px-4 py-6 text-white rounded-xl text-xl">DODAJ U PLANER</button>
</form>
    <hr />
    <h2>Plan za celu nedelju</h2>
  @foreach($planner as $plan)
    <div style="margin-bottom: 15px;">
        <strong>{{ $plan->tip_vezbe->naziv }}</strong>
        ({{ $plan->tip_vezbe->muscle_group }})  
        — Cilj: {{ $plan->goal_weight }}kg × {{ $plan->goal_reps }} ponavljanja  
        [{{ ucfirst($plan->status) }}]
        <form action="{{ route('planner.destroy', $plan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Da li ste sigurni da želite obrisati ovaj plan?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="border p-1 text-red-500 hover:underline ml-2 align-middle">
                X
            </button>
        </form>
    </div>
@endforeach

    </div>
        
         
</x-layouts.app>






<script>
document.getElementById('exerciseSelect').addEventListener('change', async function() {
    const id = this.value;
    const display = document.getElementById('lastMax');
    const goal = document.getElementById('goalWeight');

    if (!id) {
        display.textContent = "Select exercise to see heaviest weight";
        return;
    }

    try {
        const response = await fetch(`/exercise/max-weight/${id}`);
        const data = await response.json();

        if (data.max_tezina && data.max_tezina > 0) {
            display.textContent = `Rekord: ${data.max_tezina} kg`;
        } else {
            display.textContent = "Nema rekorda jos.";
            goal.value = "";
        }
    } catch (err) {
        console.error("Error fetching max weight:", err);
        display.textContent = "Neuspesno uzimanje rekord-a.";
    }
});
</script>