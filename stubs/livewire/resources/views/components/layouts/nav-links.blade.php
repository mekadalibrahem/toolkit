<ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

    <x-layouts.link  :active="(Route::currentRouteName() == 'dashboard') ?? true" href="{{Route('dashboard')}}" > Dashboard </x-layouts.link>

   <x-layouts.link  :active="(Route::currentRouteName() == 'profile.create') ?? true" href="{{ Route('profile.create') }}" >
       Profile
   </x-layouts.link>

</ul>
