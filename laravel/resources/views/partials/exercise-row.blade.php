<tr class="even:bg-neutral-50 dark:even:bg-neutral-800">
    <td class="flex items-center justify-between">
        {{ $exercise->tip_vezbe->naziv }}
        <form action="{{ route('gym-progress.destroy', $exercise->id) }}" method="POST" onsubmit="return confirm('Delete this exercise?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="ml-2 text-red-500 hover:bg-red-100 rounded px-1">X</button>
        </form>
    </td>
    <td>{{ $exercise->max_tezina }}</td>
    <td>{{ $exercise->ponavljanja }}</td>
</tr>