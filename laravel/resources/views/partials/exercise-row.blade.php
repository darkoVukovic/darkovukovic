<tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
    <td class="pl-4">{{ $exercise->tip_vezbe->naziv }}</td>
    <td class="text-center">{{ $exercise->max_tezina }}</td>
    <td class="text-center">{{ $exercise->ponavljanja }}</td>
    <td class="text-center">
        <form action="{{ route('gym-progress.destroy', $exercise->id) }}" method="POST" onsubmit="return confirm('Obrisati vežbu?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded px-2 py-1">
                🗑️
            </button>
        </form>
    </td>
</tr>