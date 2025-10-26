<x-layouts.app :title="__('Dashboard')">
    <div class="my-5">
            <h3 class="text-center">{{$vreme}}</h3>

    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl"> 
            <h1>Planner</h1>

   <form action="{{ route('planner.store') }}" method="POST" class="flex flex-col max-w-xl mx-auto p-4 bg-white shadow rounded space-y-4" >
    @csrf

    <label>Exercise:</label>
    <select name="tip_vezbe_id" id="exerciseSelect">
        <option value="">-- Select exercise --</option>
        @foreach($exercises as $ex)
            <option value="{{ $ex->id }}">{{ $ex->naziv }} ({{ $ex->muscle_group }})</option>
        @endforeach
    </select>

    <p id="lastMax" style="margin-top:5px; color:gray;">Select exercise to see heaviest weight</p>

    <label>Goal weight:</label>
    <input  class="input-underline" type="number" step="0.5" name="goal_weight" id="goalWeight" required>

    <label>Goal reps:</label>
    <input  class="input-underline" type="number" name="goal_reps" value="" required>

    <label>Date:</label>
    <input  class="input-underline" type="date" name="planned_date" value="{{ now()->toDateString() }}">

    <button type="submit">Add to Planner</button>
</form>
    
  @foreach($planner as $plan)
    <div style="margin-bottom: 15px;">
        <strong>{{ $plan->tip_vezbe->naziv }}</strong>
        ({{ $plan->tip_vezbe->muscle_group }})  
        — Cilj: {{ $plan->goal_weight }}kg × {{ $plan->goal_reps }} ponavljanja  
        [{{ ucfirst($plan->status) }}]
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
            display.textContent = `Heaviest so far: ${data.max_tezina} kg`;
        } else {
            display.textContent = "No previous records yet.";
            goal.value = "";
        }
    } catch (err) {
        console.error("Error fetching max weight:", err);
        display.textContent = "Could not load heaviest weight.";
    }
});
</script>