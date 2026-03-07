<x-layouts.app :title="__('Dashboard')">
     <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
           <div class="flex items-center justify-center min-h-screen">
            <form method="POST" action="store" class="flex flex-col max-w-xl mx-auto p-4 w-full  bg-white shadow rounded space-y-4" >
                @csrf
                <label for="Dan">Dan:</label>
                <input type="date" id="Dan" name="Dan"  class="input-underline"
                list="days"
                  required 
                 autocomplete="off">  
                <datalist id='days'>
                    <option value="Ponedeljak">
                    <option value="Utorak">
                    <option value="Sreda">
                    <option value="Cetvrtak">
                    <option value="Petak">
                </datalist>


                 <label for="tip_vezbe">Tip vezbe: </label>
                <input type="text" id="tip_vezbe" name="tip_vezbe"
                 class="input-underline"
                 list="exercises" 
                placeholder="Unesite ili izaberite vežbu"
                required 
                 autocomplete="off">
                <datalist id="exercises">
                    
                @foreach($existingExercise as $exercise)
                 <option value="{{ $exercise->naziv }}">
                @endforeach
                </datalist>
                 <label for="max_tezina">max tezina: </label>
                <input type="number" step=0.01 min=0 id="max_tezina" name="max_tezina"  class="input-underline">
                
                <div id="inkrement_wrapper">
                <label for="inkrement">Inkrement (kg):</label>
                <input type="number" step="0.25" min="0.25" id="inkrement" name="inkrement" 
                    class="input-underline" value="2.5">
            </div>

                 <label for="ponavljanja">Ponavljanja: </label>
                <input type="number" id="ponavljanja" name="ponavljanja"  class="input-underline">

               <div id="muscle_group_wrapper">
                    <label for="muscle_group">Muscle Group:</label>
                    <input list="muscleGroups" name="muscle_group" id="muscle_group" placeholder="Type or select" class="input-underline">
                    <datalist id="muscleGroups">
                        @foreach($muscleGroups as $group)
                            <option value="{{ $group->name }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <button class="bg-pink-500 px-4 py-6 text-white rounded-xl text-2xl ">Sacuvaj</button>
            </form>
        </div>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>



    <script>
        // Napravi mapu: naziv vezbe => muscle_group
        const exercises = {
            @foreach($existingExercise as $exercise)
                "{{ $exercise['naziv'] }}": "{{ $exercise['muscle_group'] }}",
            @endforeach
        };

        const tipVezbeInput = document.getElementById('tip_vezbe');
      const muscleGroupWrapper = document.getElementById('muscle_group_wrapper');
const inkrementWrapper = document.getElementById('inkrement_wrapper');

tipVezbeInput.addEventListener('input', function () {
    const selected = exercises[this.value];
    if (selected) {
        muscleGroupWrapper.style.display = 'none';
        inkrementWrapper.style.display = 'none';
    } else {
        muscleGroupWrapper.style.display = 'block';
        inkrementWrapper.style.display = 'block';
    }
});

        
    </script>
</x-layouts.app>
