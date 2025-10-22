<x-layouts.app :title="__('Dashboard')">
     <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form method="POST" action="store">
                @csrf
                <label for="Dan">Dan</label>
                <input type="text" id="Dan" name="Dan">

                 <label for="tip_vezbe">Tip vezbe</label>
                <input type="text" id="tip_vezbe" name="tip_vezbe">
                
                 <label for="max_tezina">max tezina</label>
                <input type="number" id="max_tezina" name="max_tezina">

                 <label for="ponavljanja">Ponavljanja</label>
                <input type="number" id="ponavljanja" name="ponavljanja">

                <button>Sacuvaj</button>
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
