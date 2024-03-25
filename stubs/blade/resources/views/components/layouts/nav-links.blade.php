<ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

     <x-layouts.link  :active="(Route::currentRouteName() == 'dashboard') ?? true" href="{{Route('dashboard')}}" > dashboard </x-layouts.link>

    <x-layouts.link href="#" :active="(Route::currentRouteName() == 'aa') ?? true" href="#" >
        Home
    </x-layouts.link>

</ul>
