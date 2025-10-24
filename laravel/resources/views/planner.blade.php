<x-layouts.app :title="__('Dashboard')">
    <div class="my-5">
            <h3 class="text-center">{{$vreme}}</h3>

    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl"> 
            <h1>Planner</h1>

            <form action="{{ route('planner.store') }}" method="POST">
    @csrf
        <label>Vezbe:</label>
        <select name="tip_vezbe_id">
            @foreach($exercises as $tip_vezbe)
                <option value="{{ $tip_vezbe->id }}">{{ $tip_vezbe->naziv }} ({{ $tip_vezbe->muscle_group }})</option>
            @endforeach
        </select>

        <label>Date:</label>
        <input type="date" name="planned_date" value="{{ now()->toDateString() }}">

        <label>Goal Reps:</label>
        <input type="number" name="goal_reps" value="5">

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
