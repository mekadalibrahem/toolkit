<x-layouts.app >
    <x-slot:title >
        dashboard
    </x-slot:title>
    <x-layouts.nav />

            <form action="{{Route('logout_handler')}}">
                <button type="submit"  >logout</button>
                @csrf
            </form>

</x-layouts.app>
