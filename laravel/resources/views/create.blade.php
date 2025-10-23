<x-layouts.app :title="__('Dashboard')">
     <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form method="POST" action="store">
                @csrf
                <label for="Dan">Dan:</label>
                <input type="text" id="Dan" name="Dan"
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
                 list="exercises" 
                placeholder="Unesite ili izaberite vežbu"
                required 
                 autocomplete="off">
                <datalist id="exercises">
                    
                @foreach($existingExercise as $exercise)
                 <option value="{{ $exercise }}">
                @endforeach
                </datalist>
                 <label for="max_tezina">max tezina: </label>
                <input type="number" id="max_tezina" name="max_tezina">

                 <label for="ponavljanja">Ponavljanja: </label>
                <input type="number" id="ponavljanja" name="ponavljanja">

             <label for="muscle_group">Muscle Group:</label>
            <input list="muscleGroups" name="muscle_group" id="muscle_group" placeholder="Type or select">
            <datalist id="muscleGroups">
                @foreach($muscleGroups as $group)
                    <option value="{{ $group->name }}"></option>
                @endforeach
            </datalist>

                <button class="bg-blue-500 px-4 py-2 text-white rounded">Sacuvaj</button>
            </form>

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
</x-layouts.app>
