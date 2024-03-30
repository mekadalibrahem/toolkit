<x-layouts.app >
    <x-slot:title >
        Profile
    </x-slot:title>
    <x-layouts.nav />
    <main class=" h-screen overflow-auto dark:bg-gray-700" >


        <livewire:profile.info />

        <livewire:profile.change-password />

        <livewire:profile.devices  />

        <livewire:profile.delete />

    </main>
</x-layouts.app>
