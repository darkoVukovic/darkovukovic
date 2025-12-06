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
    <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow mb-3" style="background-color: #1a1d2e; border-color: #ff006e; box-shadow: 0 0 15px rgba(255, 0, 110, 0.2);">
        <div class="flex items-start justify-between gap-3 flex-wrap sm:flex-nowrap">
            <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-lg" style="color: #f8fafc;">
                    {{ $plan->tip_vezbe->naziv }}
                    <span class="inline-block ml-2 px-2 py-0.5 rounded text-xs font-medium" style="background-color: rgba(255, 0, 110, 0.2); color: #ff006e;">
                        {{ $plan->tip_vezbe->muscle_group }}
                    </span>
                </h3>
                
                <div class="mt-2 text-sm space-y-0.5" style="color: #cbd5e1;">
                    <p><strong>Cilj:</strong> {{ $plan->goal_weight }}kg × {{ $plan->goal_reps }} ponavljanja</p>
                    <p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium" 
                              style="background-color: {{ $plan->status === 'completed' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(148, 163, 184, 0.2)' }}; 
                                     color: {{ $plan->status === 'completed' ? '#4ade80' : '#94a3b8' }};">
                            {{ ucfirst($plan->status) }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="flex-shrink-0">
                <form action="{{ route('planner.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite obrisati ovaj plan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all hover:scale-105" 
                            style="background-color: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid #ef4444;">
                        ✕ Obriši
                    </button>
                </form>
            </div>
        </div>
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